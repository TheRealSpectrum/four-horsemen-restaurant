<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;

final class ReservationController extends Controller
{
    public function index()
    {
        $late = [];
        $active = [];
        $upcoming = [];
        $later = [];

        $tomorrow = new \DateTime("tomorrow");
        $now = new \DateTime("now");
        $plusOneHour = new \DateTime("+1hour");

        $data = Reservation::where("date_start", "<", $tomorrow)
            ->where("done", false)
            ->where("canceled", false)
            ->with("tables")
            ->orderBy("date_start")
            ->get();

        foreach ($data as $reservation) {
            if ($reservation->date_start > $plusOneHour) {
                array_push($later, $reservation);
                continue;
            }

            if ($reservation->date_start > $now) {
                array_push($upcoming, $reservation);
                continue;
            }

            if ($reservation->active) {
                array_push($active, $reservation);
                continue;
            }

            array_push($late, $reservation);
        }

        return view("reservations.index", [
            "reservations" => $data,
            "late" => $late,
            "active" => $active,
            "upcoming" => $upcoming,
            "later" => $later,
        ]);
    }

    public function create()
    {
        $data = Reservation::with("tables")->get();
        $tables = Table::all();
        $pivot = [];
        foreach ($data as $reservation) {
            foreach ($reservation->tables as $table) {
                array_push($pivot, [
                    "reservation_id" => $reservation->id,
                    "table_id" => $table->id,
                ]);
            }
        }

        return view("reservations.create", [
            "data" => $data,
            "tables" => $tables,
            "pivot" => $pivot,
        ]);
    }

    public function dummyCreate()
    {
        $data = Reservation::with("tables")->get();
        $tables = Table::all();
        $pivot = [];
        foreach ($data as $reservation) {
            foreach ($reservation->tables as $table) {
                array_push($pivot, [
                    "reservation_id" => $reservation->id,
                    "table_id" => $table->id,
                ]);
            }
        }

        return view("reservations.dummy", [
            "data" => $data,
            "tables" => $tables,
            "pivot" => $pivot,
        ]);
    }

    public function store(Request $request)
    {
        $request["date_start"] = new Carbon(
            $request["date"] . " " . $request["time"] . ":00"
        );
        $request["date_end"] = clone $request["date_start"];
        $request["date_end"]->addMinutes($request->input("endTime"));

        $reservations = Reservation::with("tables")->get();
        $asignedTables = explode(",", $request->tables);
        $tableValidation = true;
        foreach ($reservations as $reservation) {
            if (
                $reservation->date_start < $request->date_start &&
                $reservation->date_end < $request->date_start
            ) {
                foreach ($reservation->tables()->get() as $table) {
                    if (array_search($table->id, $asignedTables)) {
                        $tableValidation = false;
                    }
                }
            }
        }
        if ($tableValidation == true) {
            $request["tablesValidated"] = true;
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string|between:2,255",
            "phone_number" => "required|string|regex:/^([0-9\s\-\+\(\)]*)$/",
            "guest_count" => "required|integer|min:1",
            "date_start" => "required|after:-10 minutes",
            "date_end" => "required|after:+50 minutes",
            "event_type" => "string|nullable",
            "table" => "required",
            "tablesValidated" => "required",
            "notes" => "string|nullable",
        ]);

        if ($validator->fails()) {
            return redirect("/reservation/new")
                ->withErrors($validator)
                ->withInput();
        }

        // $request["active"] = false;

        $newReservation = Reservation::create($request->all());

        foreach (explode(",", $request->input("table")) as $table) {
            $newReservation->tables()->attach(intval($table));
        }

        return redirect("/reservation")->with(
            "success",
            "The reservation is set"
        );
    }

    public function edit()
    {
        $data = Reservation::with("tables")->get();
        $tables = Table::all();
        $pivot = [];
        foreach ($data as $reservation) {
            foreach ($reservation->tables as $table) {
                array_push($pivot, [
                    "reservation_id" => $reservation->id,
                    "table_id" => $table->id,
                ]);
            }
        }
        return view("reservations.edit", [
            "data" => $data,
            "tables" => $tables,
            "pivot" => $pivot,
        ]);
    }

    public function update(Request $data)
    {
        $reservation = Reservation::where("id", $data->input("id"))->first();
        if ($data->input("action") === "update") {
            $data["date_start"] = new Carbon(
                $data["date"] . " " . $data["time"] . ":00"
            );

            $data["date_end"] = clone $data["date_start"];
            $data["date_end"]->addMinutes($data->input("endTime"));

            $reservations = Reservation::with("tables")->get();
            $asignedTables = explode(",", $data->tables);
            $tableValidation = true;
            foreach ($reservations as $otherReservation) {
                if (
                    $otherReservation->date_start < $data->date_start &&
                    $otherReservation->date_end < $data->date_start &&
                    $otherReservation->id != $reservation->id
                ) {
                    foreach ($reservation->tables()->get() as $table) {
                        if (array_search($table->id, $asignedTables)) {
                            $tableValidation = false;
                        }
                    }
                }
            }
            if ($tableValidation == true) {
                $data["tablesValidated"] = true;
            }
            // dd(get_defined_vars());
            $validator = Validator::make($data->all(), [
                "name" => "string|between:2,255",
                "phone_number" => "string|regex:/^([0-9\s\-\+\(\)]*)$/",
                "guest_count" => "integer|min:1",
                "date_start" => "after:-10 minutes",
                "date_end" => "after:+50 minutes",
                "event_type" => "string|nullable",
                "table" => "required",
                "tablesValidated" => "required",
                "notes" => "string|nullable",
            ]);

            if ($validator->fails()) {
                return redirect("/agenda?showValidationErrors")
                    ->withErrors($validator)
                    ->withInput()
                    ->with("showValidationErrors", "$reservation->id");
            }

            $reservation->fill($data->all());

            $tablesOnReservation = [];
            foreach ($reservation->tables()->get() as $pivot_table) {
                array_push(
                    $tablesOnReservation,
                    $pivot_table->getOriginal()["pivot_table_id"]
                );
            }
            foreach (explode(",", $data->input("table")) as $table) {
                if (in_array($table, $tablesOnReservation) == false) {
                    $reservation->tables()->attach(intval($table));
                }
            }
            foreach ($tablesOnReservation as $pivot_table) {
                if (
                    in_array(
                        "$pivot_table",
                        explode(",", $data->input("table"))
                    ) === false
                ) {
                    $reservation->tables()->detach($pivot_table);
                }
            }
            $reservation->save();
            return redirect("/agenda");
        } elseif ($data->input("action") === "cancel") {
            $reservation->canceled = true;
            foreach ($reservation->tables()->get() as $pivot_table) {
                $reservation
                    ->tables()
                    ->detach($pivot_table->getOriginal()["pivot_table_id"]);
            }
            $reservation->save();
            return redirect(
                "/reservations?notifyReservationCancel=$reservation->id"
            );
        } elseif ($data->input("action") === "activate") {
            // TODO add database transaction
            $reservation->active = true;
            foreach ($reservation->tables()->get() as $pivot_table) {
                $table = Table::where(
                    "id",
                    $pivot_table->getOriginal()["pivot_table_id"]
                )->first();
                $table->active = true;
                $table->save();
            }
            $reservation->save();
            return redirect("/reservations?notifyGuestUpdate=$reservation->id");
        } elseif ($data->input("action") === "done") {
            $reservation->done = true;
            $reservation->save();
            return redirect("/reservations?notifyGuestDone=$reservation->id");
        } elseif ($reservation === null) {
        }
    }
}
