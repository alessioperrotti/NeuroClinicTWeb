<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ClinicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $clins = DB::table('user')->where('usertype', 'C')->get();
        $num = count($clins);
        $usernames = $clins->pluck('username');

        foreach(range(1, $num) as $index){

            try{
                DB::table('clinico')->insert([
                    'username' => $faker->randomElement($usernames),
                    'nome' => $faker->firstName,
                    'cognome' => $faker->lastName,
                    'data_nasc' => $faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
                    'ruolo' => $faker->randomElement(['Medico', 'Fisioterapista']),
                    'specializ' => $faker->randomElement(['Neurologo', 'Ortopedico', 'Podologo', 
                        'Radiologo', 'Terapista del dolore', 'Fisiatra', 'Terapista della mano']),
                ]);
            } catch(\Exception) { continue;}
        }
    }
}
