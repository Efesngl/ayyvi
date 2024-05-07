<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\UserPetitionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::controller(AuthController::class)->group(function () {
    Route::get("/logout", "logout")->name("logout")->middleware("auth");
    Route::post("/login","login")->name("login");
    Route::inertia("/login", "Auth/Login")->name("login");
});
Route::inertia("/register", "Auth/Register")->name("register");
Route::resource("/petition", PetitionController::class)->middleware("auth");
Route::post("petitionbanner",[PetitionController::class,"uploadPetitionBanner"])->middleware("auth")->name("petition.uploadBanner");
Route::resource("/user",UserController::class)->only(["store","update"]);
Route::prefix("/account")->middleware("auth")->group(function(){
    Route::singleton("/profile",ProfileController::class)->only(["show","update"]);
    Route::singleton("/mypetitions",UserPetitionController::class);
});