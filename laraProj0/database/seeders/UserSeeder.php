<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');

        foreach(range(1,25) as $index){

            try{
                DB::table('user')->insert([
                    'username' => substr($faker->unique()->userName, 0, 20),
                    'password' => substr($faker->city, 0, 20),  // ovviamente è solo per testing
                    'usertype' => $faker->randomElement(['C', 'P']),
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
