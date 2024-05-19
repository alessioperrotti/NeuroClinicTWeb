<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TerapiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $pazs = DB::table('user')->where('usertype', 'P')->pluck('username');
        $num = count($pazs);
        
        foreach(range(1, $num) as $item){

            try{
                DB::table('terapia')->insert([
                    'data' => $faker->dateTimeThisYear(),
                    'paziente' => $faker->unique()->randomElement($pazs),
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
