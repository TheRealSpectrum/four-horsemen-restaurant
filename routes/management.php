<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Management\{
    DishesController,
    IngredientsController
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
