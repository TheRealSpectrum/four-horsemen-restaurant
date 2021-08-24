<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;

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
            ->with("tables")
            ->orderBy("date_start")
            ->get();

        foreach ($data as $reservation) {
            if ($reservation->date_start > $plusOneHour) {
                array_push($later, $reservation);
                continue;
            }

            if ($reservation->date_start > $now) {
                array_push($upcoming . $reservation);
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

    public function edit()
    {
        $data = Reservation::all();
        return view("reservations.edit", ["reservations" => $data]);
    }
}
