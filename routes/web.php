<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,"index"])->name("home");
Route::controller(AuthController::class)->group(function(){
    Route::inertia("/login","Auth/Login")->name("login");
    Route::inertia("/register","Auth/Register")->name("register");
    Route::post("login","login")->name("login");
    Route::post("/register","register")->name("register");
    Route::get("/logout","logout");
});