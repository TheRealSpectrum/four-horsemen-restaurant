<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Management\{
    DishesController,
    IngredientsController,
    TablesController,
    UsersController,
};

/*
 * Generic routes usually accessed by a browser.
 *
 * middleware: 'web', 'auth'
 * name: 'management.'
 * prefix: 'management/'
 */

Route::Resource("dishes", DishesController::class);
Route::Resource("ingredients", IngredientsController::class);
Route::Resource("employees", UsersController::class);
Route::Resource("tables", TablesController::class)->only(["index", "store", "update", "destroy"]);
