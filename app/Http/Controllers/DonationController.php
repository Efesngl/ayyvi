<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $donations=Donation::where("user_id",Auth::user()->id)->get();
        return Inertia::render("User/Donations",[
            "donations"=>$donations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render("Donation/Donate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $year = Carbon::now()->year;
        $month = ($request->input("card.cardExp.y")>$year)?1:Carbon::now()->addMonth()->month;
        $validated_request = $request->validate([
            "card.cardHolder" => "required|string|",
            "card.cardNumber" => "required|max:19|regex:'^(?:\d{4}\s?){3}\d{4}$'",
            "card.cardExp.m" => "required|integer|between:1,12|min:{$month}",
            "card.cardExp.y" => "required|integer|min:{$year}",
            "card.cardCvv" => "required|integer|min:001|max:999|digits:3",
            "amount" => "required|integer|min:1"
        ]);
        $dontaion = Donation::create([
            "user_id" => $request->user()->id,
            "amount" => $validated_request["amount"]
        ]);
        if ($dontaion) {
            return to_route("donate.status",["status"=>"success"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function status(Request $request,$status)
    {
        if($request->header("referer")!="http://127.0.0.1:8000/donate/create"){
            return to_route("donate.create");
        }
        return Inertia::render("Donation/DonationStatus", [
            "status" => $status
        ]);
    }
}
