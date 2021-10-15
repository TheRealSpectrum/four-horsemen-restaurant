<?php

namespace App\Http\Controllers;

use App\Models\Order;

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
    public function closeOrder()
    {
    }

    // Get route to poll new orders
    public function orders(): JsonResponse
    {
        $orders = Order::where("done", false)->get();
        return response()->json([
            "orders" => $orders->map(function (Order $order) {
                return [
                    "orderNum" => $order->id,
                    "status" => "Ongoing",
                    "course" => 1,
                    "dishes" => [],
                    "time" => "11:00",
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
