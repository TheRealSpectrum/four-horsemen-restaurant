<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $late = [];
        $active = [];
        $upcoming = [];
        $later = [];
        $tomorow = new \DateTime(strtotime("tomorrow"));
        $now = new \DateTime(strtotime("now"));
        $plus1hour = new \DateTime(strtotime("+1hour"));
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

    public function create()
    {
        return view("reservations.create");
    }

    public function store()
    {
        return "store called";
    }

    public function edit()
    {
        $data = Reservation::all();
        return view("reservations.edit", ["reservations" => $data]);
    }
}
