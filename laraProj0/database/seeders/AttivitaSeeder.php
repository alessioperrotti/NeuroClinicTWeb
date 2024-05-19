<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AttivitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $att = [
            "Esercizi di Coordinazione",
            "Rieducazione Posturale",
            "Ginnastica Dolce",
            "Idrokinesiterapia",
            "Fisioterapia Manuale",
            "Terapia Occupazionale",
            "Esercizi di Equilibrio",
            "Riabilitazione Neuromotoria",
            "Potenziamento Muscolare",
            "Camminata Assistita"
        ];

        foreach(range(1,10) as $items){

            try{
                DB::table('attivita')->insert([
                        'nome' => $faker->randomElement($att),
                        'descr' => "",
                    ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
