<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

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

    public function store(Request $request)
    {
        // array:2 [
        //     "table" => 9
        //     "dishes" => array:1 [▼
        //         0 => array:2 [▼
        //             "type" => "normal"
        //             "items" => array:1 [▼
        //                 0 => array:8 [▼
        //                     "id" => 1
        //                     "name" => "quas molestias nam"
        //                     "price" => 6999
        //                     "minutes_to_prepare" => 30
        //                     "created_at" => "2021-10-12T07:49:37.000000Z"
        //                     "updated_at" => "2021-10-12T07:49:37.000000Z"
        //                     "amount" => 2
        //                     "note" => null
        //                 ]
        //             ]
        //         ]
        //     ]
        // ]
    }
}
