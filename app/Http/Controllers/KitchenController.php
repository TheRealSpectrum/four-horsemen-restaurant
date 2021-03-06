<?php

namespace App\Http\Controllers;

use App\Models\{Order, OrderDish, Course};

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KitchenController extends Controller
{
    // View to see active orders
    public function index()
    {
        return view("kitchen.index");
    }

    // Post route to print orders (fake for now)
    public function printOrder()
    {
    }

    // Post route to close orders
    public function closeCourse(Request $request)
    {
        $course = Course::find($request->id);
        $course->done = true;
        $course->save();
        return "Course " . $request->id . " is successfully set as done";
    }

    // Get route to poll new orders
    public function orders(): JsonResponse
    {
        $orders = Order::has("firstOpenCourse")
            ->with("firstOpenCourse")
            ->with("table")
            ->get();
        return response()->json([
            "orders" => $orders->map(function (Order $order) {
                return [
                    "orderNum" => $order->table->id,
                    "courseId" => $order->firstOpenCourse->id,
                    "status" => "Ongoing",
                    "course" => $order->firstOpenCourse->index,
                    "dishes" => $order->firstOpenCourse->dishes->map(function (
                        OrderDish $dish
                    ) {
                        return [
                            "name" => $dish->dish->name,
                            "amount" => $dish->amount,
                            "note" => $dish->note,
                        ];
                    }),
                    "time" => $order->updated_at->format("H:i"),
                ];
            }),
        ]);
    }

    // View to edit ingredient in stock
    public function viewStock()
    {
    }

    // Patch route to edit ingredients in stock
    public function editStock()
    {
    }
}
