<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Management\{
    DishesController,
    IngredientsController,
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
