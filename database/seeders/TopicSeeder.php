<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $topics= [
            ["topic"=>"Aile"],
            ["topic"=>"Ekonomi"],
            ["topic"=>"Hayvan hakları"],
            ["topic"=>"Adalet"],
            ["topic"=>"Kadın hakları"],
            ["topic"=>"Eğitim"],
            ["topic"=>"Eğlence"],
            ["topic"=>"Engellier"],
            ["topic"=>"İnsan hakları"],
            ["topic"=>"Siyaset"],
            ["topic"=>"İnternet"],
            ["topic"=>"Lgbtq hakları"],
            ["topic"=>"Çevre"]
        ];
        Topic::insert($topics);
    }
}
