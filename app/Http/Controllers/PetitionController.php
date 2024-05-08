<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $petitions=Petition::whereNotNull("petition_banner")->get();
        $topics=[];
        return Inertia::render("Browse/Browse",[
            "petitions"=>$petitions,
            "topics"=>$topics
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $petition=[
            "petitionHeader"=>"",
            "petitionContent"=>"",
            "petitionTopic"=>0,
            "petitionBanner"=>"",
            "petitionType"=>0,
            "targetSign"=>0,
            "creator"=>Auth::user()->id ?? null
        ];
        $topics=Topic::all();
        return Inertia::render("NewPetition/StartPetition",[
            "petition"=>$petition,
            "topics"=>$topics,
            "_token"=>csrf_token()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $petitionDetail=$request->validate([
            "petitionHeader"=>"required",
            "petitionTopic"=>"required",
            "petitionType"=>"required",
            "petitionContent"=>"required|string",
            "targetSign"=>"required|min:10|integer",
            "creator"=>"required"
        ]);
        $petition=new Petition;
        $petition->petition_header=$petitionDetail["petitionHeader"];
        $petition->petition_content=$petitionDetail["petitionContent"];
        $petition->creator=$petitionDetail["creator"];
        $petition->target_sign=$petitionDetail["targetSign"];
        $petition->status=1;
        $petition->save();
        $petition->topic()->attach($petitionDetail["petitionTopic"]);
        return Inertia::location("petition.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $petition=Petition::with("topic")->findOrFail($id);
        return Inertia::render("User/EditPetition",[
            "petition"=>$petition,
            "topics"=>Topic::all(),
            "csrf_token"=>csrf_token()
        ]);
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
    function uploadBanner(Request $request){
        $request->file("file")->storeAs("public/petition_content/1","banner.jpg");
    }
    function userPetitions(){
        $petitions=Petition::where("creator",Auth::user()->id)->get();
        return Inertia::render("User/UserPetitions",[
            "petitions"=>$petitions
        ]);
    }
}
