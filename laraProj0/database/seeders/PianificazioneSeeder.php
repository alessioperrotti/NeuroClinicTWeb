<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PianificazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $ters = DB::table('terapia')->pluck('ID');
        $att = DB::table('attivita')->pluck('ID');
        $freqs = [
            "1 volta al giorno",
            "3 volte a settimana",
            "2 volte al giorno",
            "4 volte a settimana",
            "2 volte a settimana"
        ];

        foreach(range(1,40) as $items){
            try{
                DB::table('pianificazione')->insert([
                    'freq' => $faker->randomElement($freqs),
                    'terapia' => $faker->randomElement($ters),
                    'attivita' => $faker->randomElement($att),
                ]);
            } catch (\Exception $e){ continue;}
        }
    }
}
