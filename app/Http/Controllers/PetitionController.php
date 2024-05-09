<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
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
        return to_route("petition.index");
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
        $petition=Petition::with(["topic"=>function(\Illuminate\Contracts\Database\Eloquent\Builder $b){
            $b->select("topic_id");
        }])->findOrFail($id);
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
        $petition=$request->validate([
            "petition_header"=>"required",
            "petition_content"=>"required",
            "topic"=>[
                "topic_id"=>"required"
            ],
            "target_sign"=>"required|integer|min:10",
            "petition_banner"=>"nullable",
            "status"=>"required"
        ]);
        $p=Petition::find($id);
        $p->petition_header=$petition["petition_header"];
        $p->petition_content=$petition["petition_content"];
        if($request->hasFile("petition_banner")){
            $p->petition_banner=str_replace("public/","storage/",$request->file("petition_banner")->storeAs("public/petition_content/{$id}","banner.jpg"));
        }
        $p->target_sign=$petition["target_sign"];
        $p->status=$petition["status"];
        $p->topic()->sync([$petition["topic"][0]["topic_id"]]);
        $p->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Petition::destroy($id);
        return redirect()->route("user.petitions");
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
