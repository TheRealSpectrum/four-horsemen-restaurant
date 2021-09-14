<?php

namespace App\Http\Controllers\Management;

use App\Models\Dish;

use Illuminate\Http\Request;

final class DishesController extends ManagementController
{
    protected string $managementModel = Dish::class;
}
