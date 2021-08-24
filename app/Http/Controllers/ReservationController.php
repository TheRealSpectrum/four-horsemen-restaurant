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

        $tomorow = \DateTime::createFromFormat("U", strtotime("tomorrow"));
        $now = \DateTime::createFromFormat("U", strtotime("now"));
        $plus1hour = \DateTime::createFromFormat("U", strtotime("+1hour"));
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
        return view("reservations.edit", ["reservations" => $data]);
    }
}
