<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use App\Models\SignedPetition;
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
    public function index(Request $request)
    {
        //
        $petitions=Petition::has("reason",">",0)
        ->withCount("reason")
        ->whereNotNull("petition_banner")
        ->when($request->has("search"),function(Builder $b) use($request){
            $b->where("petition_header","like","%{$request->input("search")}%");
        })
        ->when($request->has("topics"),function(Builder $b) use($request){
            $b->whereHas("topic",function(Builder $b) use($request){
                $b->whereIn("topic_id",$request->input("topics"));
            });
        })
        ->when($request->has("type"),function(Builder $b) use($request){
            switch ($request->input("type")){
                case 1:
                    $b->withCount("reason")->orderBy("reason_count","desc");
                    break;
                case 2:
                    $b->orderBy("created_at","desc");
                    break;
                case 3:
                    $b->where("status",3);
                    break;
            }
        })
        ->paginate(10);
        $topics=Topic::all();
        return Inertia::render("Browse/Browse",[
            "petitions"=>$petitions,
            "topics"=>$topics,
            "url_query"=>$request->all()
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
        return to_route("petition.edit",["petition"=>$petition->id])->with("error","You need to upload a banner yo your petition ! Otherwise it wont be seen by others");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $petition=Petition::with("user","reason")->withCount("reason")->findOrFail($id);
        $is_signed=(!is_null(Auth::user()))?SignedPetition::where("user_id",Auth::user()->id)->where("petition_id",$id)->exists():null;
        $reasons=Petition::find($id)->reason()->with(["user"=>function(\Illuminate\Contracts\Database\Eloquent\Builder $b){
            $b->select("name","id")->get();
        }])->where("will_shown",true)->get();
        return Inertia::render("Petition/PetitionDetail",[
            "petition"=>$petition,
            "content"=>$petition->getRawOriginal("petition_content"),
            "is_signed"=>$is_signed,
            "reasons"=>$reasons
        ]);
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
        Petition::destroy($id);
        return to_route("user.petitions")->with("success","Petition is deleted.");
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
