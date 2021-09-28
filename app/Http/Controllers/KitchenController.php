<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function pollOrder()
    {
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
