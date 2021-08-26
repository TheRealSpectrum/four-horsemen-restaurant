<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
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

Route::name("reservation.")->group(function () {
    route::get("/reservation", [ReservationController::class, "index"])->name(
        "index"
    );
    route::get("/agenda", [ReservationController::class, "edit"])->name("edit");
    Route::get("/reservation/new", [
        ReservationController::class,
        "create",
    ])->name("create");
    Route::post("/reservation/store", [
        ReservationController::class,
        "store",
    ])->name("store");
});

//test routes
