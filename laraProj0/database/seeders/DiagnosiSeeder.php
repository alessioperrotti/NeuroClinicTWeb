<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DiagnosiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $pazs = DB::table('user')->where('usertype', 'P')->get();
        $usernames = $pazs->pluck('username');
        $dists = DB::table('distmotorio')->pluck('nome');

        foreach(range(1,40) as $item){
            try{
                DB::table('diagnosi')->insert([
                    'paziente' => $faker->randomElement($usernames),
                    'disturbo' => $faker->randomElement($dists),
                    'data' => $faker->dateTimeThisYear(),
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
