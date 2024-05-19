<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FarmacoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $meds = [
            "Levodopa 100mg",
            "Carbidopa 25mg",
            "Baclofen 10mg",
            "Tizanidine 2mg",
            "Gabapentin 300mg",
            "Dantrolene 25mg",
            "Diazepam 5mg",
            "Tolcapone 100mg",
            "Ropinirole 0.25mg",
            "Pramipexole 0.125mg"
        ];

        foreach(range(1,10) as $items){

            try{
                DB::table('attivita')->insert([
                    'nome' => $faker->randomElement($meds),
                    'descr' => "",
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
