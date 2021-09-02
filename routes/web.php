<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    ReservationController
};

/*
 * Generic routes usually accessed by a browser.
 *
 * middleware: 'web'
 */

Route::get("/", function () {
    return view("welcome");
})->name("home");

Route::name("auth.")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "authenticate"])->name(
        "authenticate"
    );
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::resource("reservations", ReservationController::class)->except("show", "destroy");
