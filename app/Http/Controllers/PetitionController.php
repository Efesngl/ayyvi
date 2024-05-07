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
        $petitions=Petition::all();
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
        //
        return $request->all();
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
        $request->file("file")->store("/petition_content/1/banner");
    }
}
