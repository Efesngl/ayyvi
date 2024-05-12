<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1;$i<=10;$i++){
            User::insert([
                "name"=>fake("tr_TR")->name(),
                "email"=>fake("tr_TR")->email(),
                "password"=>"12345"
            ]);
        }
    }
}
