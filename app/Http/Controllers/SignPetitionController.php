<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use App\Models\SignedPetition;
use Illuminate\Http\Request;

class SignPetitionController extends Controller
{
    //
    public function signPetition(Request $request,$petition_id){
        $validate=$request->validate([
            "reason"=>"nullable|required_if:willShown,true",
            "willShown"=>"boolean|required"
        ]);
        Petition::find($petition_id)->reason()->create([
            "user_id"=>$request->user()->id,
            "will_shown"=>$validate["willShown"],
            "reason"=>$validate["reason"]
        ]);
        return to_route("petition.show",$petition_id);
    }
    public function unsignPetition(Request $request,$petition_id){
        Petition::find($petition_id)->reason()->where("user_id",$request->user()->id)->delete();
        return to_route("petition.show",$petition_id);
    }
    public function like(Request $request,$petition_id){
        Petition::find($petition_id)->reason()->where("id",$request->input("reason_id"))->increment("likes");
    }
}
