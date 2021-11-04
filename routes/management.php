<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Management\{
    DishesController,
    DrinksController,
    IngredientsController,
    TablesController,
    UsersController,
    AdvancedController,
    CategoriesController,
};

/*
 * Generic routes usually accessed by a browser.
 *
 * middleware: 'web', 'auth'
 * name: 'management.'
 * prefix: 'management/'
 */

Route::resource("dishes", DishesController::class);
Route::resource("drinks", DrinksController::class);
Route::resource("ingredients", IngredientsController::class);
Route::resource("employees", UsersController::class);
Route::resource("tables", TablesController::class)->only(["index", "store", "update", "destroy"]);
Route::resource("categories", CategoriesController::class);

Route::prefix("advanced/")->name("advanced.")->group( function () {
    Route::get("/", [AdvancedController::class, "index"])->name("index");
    Route::put("/{setting}", [AdvancedController::class, "update"])->name("update");
});
