<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use App\Models\{
    Reservation,
    Table,
    Order,
    OrderDish,
    Dish,
    Course,
    Drink,
    Carbon
};

class OrderController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with("tables")->get();

        return view("order.index", [
            "reservations" => Reservation::with("tables")->get(),
            "dishes" => Dish::all(),
            "drinks" => Drink::all(),
            "tables" => Table::with("reservations")->get(),
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

        foreach ($request["dishes"] as $i => $course) {
            $newCourse = new Course();

            $newCourse->order()->associate($order);
            $newCourse->type = $course["type"];
            $newCourse->index = $i + 1;
            $newCourse->save();

            foreach ($course["items"] as $dish) {
                $dishModel = Dish::find($dish["id"]);
                $newOrderDish = new OrderDish();

                $newOrderDish->dish()->associate($dishModel);
                $newOrderDish->course()->associate($newCourse);
                $newOrderDish->amount = $dish["amount"];
                $newOrderDish->note = $dish["note"];

                $newOrderDish->save();
            }
        }
    }
}
