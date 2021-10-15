<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    HomeController,
    KitchenController,
    OrderController,
    ReservationController
};

/*
 * Generic routes usually accessed by a browser.
 *
 * middleware: 'web'
 */

Route::get("/", HomeController::class)->name("home")->middleware("auth");

Route::name("auth.")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "authenticate"])->name("authenticate");
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::resource("reservations", ReservationController::class)->except("show", "destroy", "edit")->middleware("auth");

// This more or less does the same thing as above, but more verbose and using non-standard naming conventions
Route::name("reservation.")->middleware("auth")->group(function () {
    route::get("/reservation", [ReservationController::class, "index"])->name("index");
    route::get("/agenda", [ReservationController::class, "edit"])->name("edit");
    route::patch("/update", [ReservationController::class, "update"])->name("update");
    Route::get("/reservation/new", [ReservationController::class, "create"])->name("create");
    Route::get("/reservation/walk-in", [ReservationController::class, "dummyCreate"])->name("dummyCreate");
    Route::post("/reservation/store", [ReservationController::class, "store"])->name("store");
});

Route::name("order.")->middleware("auth")->group(function(){
    Route::get("/order/new", [OrderController::class, "index"])->name("index");
    Route::post("/order/store", [OrderController::class, "store"])->name("store");
});

Route::name("kitchen.")->middleware("auth")->group(function() {
    Route::get("/kitchen", [KitchenController::class, "index"])->name("index");
});
