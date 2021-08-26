<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $late = [];
        $active = [];
        $upcoming = [];
        $later = [];
        $tomorow = \DateTime::createFromFormat("U", strtotime("tomorrow"));
        $now = \DateTime::createFromFormat("U", strtotime("now"));
        $plus1hour = \DateTime::createFromFormat("U", strtotime("+1hour"));
        print_r($now);
        echo "<br>";
        print_r($plus1hour);
        echo "<br>";
        print_r($tomorow);
        $data = Reservation::all();
        foreach ($data as $reservation) {
            if (
                $reservation->date_start > $now &&
                $reservation->date_start < $plus1hour
            ) {
                array_push($upcoming, $reservation);
            } elseif ($reservation->date_start < $now && $reservation->active) {
                array_push($active, $reservation);
            } elseif (
                $reservation->date_start < $now &&
                $reservation->acrive == 0
            ) {
                array_push($late, $reservation);
            } elseif (
                $reservation->date_start > $plus1hour &&
                $reservation->date_start < $tomorow
            ) {
                array_push($later, $reservation);
            }
        }
        return view("reservations.index", [
            "late" => $late,
            "active" => $active,
            "upcoming" => $upcoming,
            "later" => $later,
        ]);
    }

    public function edit()
    {
        $data = Reservation::all();
        $tables = Table::all();
        $pivot = [];
        foreach($data as $reservation){
            foreach($reservation->tables as $table){
                array_push($pivot,["reservation_id"=>$reservation->id,"table_id"=>$table->id]);
            }
        }
        return view("reservations.edit", ["data" => $data, "tables" => $tables, "pivot"=>$pivot]);
    }
}
