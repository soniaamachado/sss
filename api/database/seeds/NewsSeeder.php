<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title'=>str_random(10),
            'description'=>str_random(10),
            'image'=>str_random(10).'.jpg',
            'user_id' => rand(1,15),
        ]);
    }
}
