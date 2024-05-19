<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PrescrizioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $ters = DB::table('terapia')->pluck('ID');
        $meds = DB::table('farmaco')->pluck('ID');
        $freqs = [
            "1 volta al giorno",
            "3 volte al giorno",
            "2 volte al giorno",
        ];

        foreach(range(1,40) as $items){

            try{
                DB::table('pianificazione')->insert([
                    'freq' => $faker->randomElement($freqs),
                    'terapia' => $faker->unique()->randomElement($ters),
                    'attivita' => $faker->unique()->randomElement($meds),
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
