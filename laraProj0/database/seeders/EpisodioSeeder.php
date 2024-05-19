<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EpisodioSeeder extends Seeder
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

        foreach(range(1,50) as $item){

            try{
                DB::table('episodio')->insert([
                    'data' => $faker->dateTimeThisYear()->format('Y-m-d'),
                    'ora' => $faker->time,
                    'durata' => $faker->numberBetween(0,10),
                    'intensita' => $faker->numberBetween(1,10),
                    'paziente' => $faker->randomElement($usernames),
                    'disturbo' => $faker->randomElement($dists),
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
