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

        foreach(range(1,15) as $index){
            DB::table('user')->insert([
                'username' => substr($faker->unique()->userName, 0, 20),
                'password' => $faker->bcrypt('password'),
                'usertype' => $faker->randomElement(['C', 'P']),
            ]);
        }
    }
}
