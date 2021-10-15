<?php

namespace App\Http\Controllers;

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
        return response()->json([
            "orders" => [
                [
                    "orderNum" => 2,
                    "status" => "onGoing",
                    "course" => 2,
                    "dishes" => [],
                    "time" => "11:00",
                ],
            ],
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
