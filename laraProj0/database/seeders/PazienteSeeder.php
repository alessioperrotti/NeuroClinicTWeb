<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PazienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');
        $pazs = DB::table('user')->where('usertype', 'P')->get();
        $num = count($pazs);
        $usernames = $pazs->pluck('username');
        $provs = [
            'AG', 'AL', 'AN', 'AO', 'AR', 'AP', 'AT', 'AV', 'BA', 'BT', 'BL', 'BN', 'BG', 'BI', 'BO', 'BZ', 'BS',
            'BR', 'CA', 'CL', 'CB', 'CI', 'CE', 'CT', 'CZ', 'CH', 'CO', 'CS', 'CR', 'KR', 'CN', 'EN', 'FM', 'FE',
            'FI', 'FG', 'FC', 'FR', 'GE', 'GO', 'GR', 'IM', 'IS', 'SP', 'AQ', 'LT', 'LE', 'LC', 'LI', 'LO', 'LU',
            'MC', 'MN', 'MS', 'MT', 'VS', 'ME', 'MI', 'MO', 'MB', 'NA', 'NO', 'NU', 'OT', 'OR', 'PD', 'PA', 'PR',
            'PV', 'PG', 'PU', 'PE', 'PC', 'PI', 'PT', 'PN', 'PZ', 'PO', 'RG', 'RA', 'RC', 'RE', 'RI', 'RN', 'RM',
            'RO', 'SA', 'VS', 'SS', 'SV', 'SI', 'SR', 'SO', 'TA', 'TE', 'TR', 'TO', 'TP', 'TN', 'TV', 'TS', 'UD',
            'VA', 'VE', 'VB', 'VC', 'VR', 'VV', 'VI', 'VT'
        ];

        $addrs = [
            "Via Roma",
            "Via Dante Alighieri",
            "Via Garibaldi",
            "Corso Vittorio Emanuele",
            "Via Verdi",
            "Via Manzoni",
            "Piazza del Popolo",
            "Via Milano",
            "Via Leonardo da Vinci",
            "Piazza San Marco",
            "Via Veneto",
            "Corso Umberto I",
            "Via XX Settembre",
            "Via Giuseppe Mazzini",
            "Via Alessandro Manzoni",
            "Piazza della Repubblica",
            "Via Guglielmo Marconi",
            "Corso Italia",
            "Via Carducci",
            "Piazza Duomo"
        ];
        $clins = DB::table('user')->where('usertype', 'C')->get();
        $usernames = $clins->pluck('username');
        $numstel = [
            '340 1234567',
            '347 2345678',
            '333 3456789',
            '348 4567890',
            '339 5678901',
            '320 6789012',
            '366 7890123',
            '389 8901234',
            '380 9012345',
            '335 0123456',
            '346 1234567',
            '328 2345678',
            '327 3456789',
            '338 4567890',
            '349 5678901',
            '380 6789012',
            '333 7890123',
            '366 8901234',
            '342 9012345',
            '388 0123456',
        ];
        
        

        foreach(range(1, $num) as $index){

            try{
                DB::table('paziente')->insert([
                    'username' => $faker->randomElement($usernames),
                    'nome' => $faker->firstName,
                    'cognome' => $faker->lastName,
                    'data_nasc' => $faker->dateTimeBetween('-100 years', '-30 years')->format('Y-m-d'),
                    'genere' => $faker->randomElement(['M', 'F', 'A']),
                    'via' => $faker->randomElement($addrs),
                    'civico' => $faker->numberBetween(1, 150),
                    'citta' => $faker->city,
                    'prov' => $faker->randomElement($provs),
                    'telefono' => $faker->randomElement($numstel),
                    'email' => $faker->freeEmail,
                    'clinico' => $faker->randomElement($usernames),               
                ]);
            } catch(\Exception $e) { continue;}
        }
    }
}
