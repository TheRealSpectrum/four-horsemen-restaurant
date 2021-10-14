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
        $table = Table::find($request["table"]);
        $user = auth()->user();

        $order = new Order();
        $order->table()->associate($table);
        $order->user()->associate($user);

        $order->save();

        // array:2 [▼
        //     "table" => 2
        //     "dishes" => array:3 [▼
        //         0 => array:2 [▼
        //             "type" => "normal"
        //             "items" => array:1 [▼
        //                 0 => array:8 [▼
        //                     "id" => 4
        //                     "name" => "minus odit harum"
        //                     "price" => 3999
        //                     "minutes_to_prepare" => 30
        //                     "created_at" => "2021-10-14T10:11:32.000000Z"
        //                     "updated_at" => "2021-10-14T10:11:32.000000Z"
        //                     "amount" => 1
        //                     "note" => "gghjghj"
        //                 ]
        //             ]
        //         ]
        //         1 => array:2 [▼
        //             "type" => "drinks"
        //             "items" => array:1 [▼
        //                 0 => array:8 [▼
        //                     "id" => 5
        //                     "name" => "voluptas aut nisi"
        //                     "price" => 5499
        //                     "minutes_to_prepare" => 30
        //                     "created_at" => "2021-10-14T10:11:32.000000Z"
        //                     "updated_at" => "2021-10-14T10:11:32.000000Z"
        //                     "amount" => 1
        //                     "note" => null
        //                 ]
        //             ]
        //         ]
        //         2 => array:2 [▼
        //             "type" => "drinks"
        //             "items" => array:1 [▼
        //                 0 => array:8 [▼
        //                     "id" => 6
        //                     "name" => "occaecati inventore fugiat"
        //                     "price" => 1499
        //                     "minutes_to_prepare" => 30
        //                     "created_at" => "2021-10-14T10:11:32.000000Z"
        //                     "updated_at" => "2021-10-14T10:11:32.000000Z"
        //                     "amount" => 1
        //                     "note" => null
        //                 ]
        //             ]
        //         ]
        //     ]
        // ]
    }
}
