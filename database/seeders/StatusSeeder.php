<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("petition_statuses")->insert([
            ["status" => "waiting for approval"], 
            ["status" => "approved"], 
            ["status" => "disapproved"], 
            ["status" => "waiting for success approval"], 
            ["status" => "success approved"],
            ["status"=>"success disapproved"],
            ["status"=>"blocked"],
        ]);
    }
}
