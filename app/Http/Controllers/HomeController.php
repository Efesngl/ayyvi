<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function index(){
        $sp=Petition::where("status_id",5)->get();
        $pp=Petition::withCount("reason")->orderBy("reason_count","desc")->get();
        return Inertia::render("Home",[
            "succededPetitions"=>$sp,
            "popularPetitions"=>$pp,
            "petitionCount"=>Petition::count()
        ]);
    }
}
