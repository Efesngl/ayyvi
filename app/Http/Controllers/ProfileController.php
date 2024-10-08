<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show(Request $request)
    {
        //
        $user=User::where("id",$request->user()->id)->first();
        return Inertia::render("User/AccountDetails",[
            "user"=>$user
        ]);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
        $data=$request->validate([
            "name"=>"required",
            'email' => [
                'required',
                "email",
                Rule::unique('users')->ignore($request->user()->id),
            ],
            "password"=>"nullable",
            'pp' =>"file|nullable"
        ]);
        $user=User::find($request->user()->id);
        $user->name=$data["name"];
        $user->email=$data["email"];
        if(!is_null($data["password"])){
            $user->password=$data["password"];
        }
        if(!is_null($data["pp"])){
            $user->profile_photo=$request->file("pp")->storeAs("user_content/{$user->id}","profile_photo.jpeg");
        }
        $user->update();
        return response("",200);
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
