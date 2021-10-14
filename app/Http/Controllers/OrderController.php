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
use App\Models\Course;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

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

        foreach ($request["dishes"] as $course) {
            $newCourse = new Course();

            $newCourse->order()->associate($order);
            $newCourse->type = $course["type"];

            $newCourse->save();

            foreach ($course["items"] as $dish) {
                $dishModel = Dish::find($dish["id"]);
                $newOrderDish = new OrderDish();

                $newOrderDish->dish()->associate($dishModel);
                $newOrderDish->course()->associate($newCourse);
                $newOrderDish->amount = $dish["amount"];
                if (!isNull($dish["note"])) {
                    $newOrderDish->note = $dish["note"];
                }

                $newOrderDish->save();
            }
        }
    }
}
