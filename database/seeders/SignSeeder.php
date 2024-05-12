<?php

namespace Database\Seeders;

use App\Models\Petition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users=User::all();
        $petition=Petition::find(10);
        foreach($users as $u){
            $petition->reason()->create([
                "user_id"=>$u->id,
                "will_shown"=>false,
                "likes"=>0,
            ]);
        }

    }
}
