<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class SignPetitionController extends Controller
{
    //
    public function signPetition(Request $request,$petition_id){
        $validate=$request->validate([
            "reason"=>"nullable|required_if:willShown,true",
            "willShown"=>"boolean|required"
        ]);
        return $validate;
        // $petition=Petition::find($petition_id);
        // $petition->reason()->insert(["user_id"=>$request->user()->id]);
    }
}
