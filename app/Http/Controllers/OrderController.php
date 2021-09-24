<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderDish;
use App\Models\Dish;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with("tables")->get();
        $tables = Table::with("reservations")->get();
        $dishes = Dish::all();

        return view("order.index", [
            "reservations" => $reservations,
            "dishes" => $dishes,
            "tables" => $tables,
        ]);
    }
}
