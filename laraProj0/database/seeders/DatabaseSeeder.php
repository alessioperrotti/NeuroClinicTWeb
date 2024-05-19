<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AttivitaSeeder::class,
            FarmacoSeeder::class,
            ClinicoSeeder::class,
            PazienteSeeder::class,
            TerapiaSeeder::class,
            PianificazioneSeeder::class,
            PrescrizioneSeeder::class,
            DistMotorioSeeder::class,
            EpisodioSeeder::class,
            DiagnosiSeeder::class,
        ]);
    }
}
