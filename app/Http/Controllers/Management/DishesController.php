<?php

namespace App\Http\Controllers\Management;

use App\Models\Dish;

use Illuminate\Http\Request;

final class DishesController extends ManagementController
{
    protected function managementInit(): void
    {
        // @prettier-ignore
        $this
            ->RegisterColumn("name", "Name", "text")
            ->registerColumn("price", "Price", "number");
    }

    protected string $managementModel = Dish::class;
    protected string $managementName = "dishes";
    protected string $managementParameterName = "dish";
}
