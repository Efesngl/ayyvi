<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignPetitionController;
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
Route::withoutMiddleware("auth")->group(function(){
    Route::resource("/petition",PetitionController::class)->only(["show","index"]);
});
Route::post("petitionbanner",[PetitionController::class,"uploadBanner"])->middleware("auth")->name("petition.uploadbanner");
Route::resource("/user",UserController::class)->only(["store","update"]);
Route::prefix("/account")->middleware("auth")->group(function(){
    Route::singleton("/profile",ProfileController::class)->only(["show","update"]);
    Route::get("/mypetitions",[PetitionController::class,"userPetitions"])->name("user.petitions");
    Route::get("/signedpetitions",[PetitionController::class,"signedPetitions"])->name("user.signedpetitions");
    Route::get("/mydonations",[DonationController::class,"index"])->name("user.donations");
});
Route::prefix("/reason")->controller(SignPetitionController::class)->group(function(){
    Route::post("/sign/{petition_id}","signPetition")->name("petition.sign");
    Route::delete("/unsign/{petition_id}","unsignPetition")->name("petition.unsign");
    Route::patch("/like/{petition_id}","like")->name("petition.reason.like");
});
Route::resource("/donate",DonationController::class)->except(["index"])->middleware("auth");
Route::get("/donate/status/{status}",[DonationController::class,"status"])->name("donate.status");