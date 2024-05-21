<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            ['username' => 'adminadmin', 'password' => Hash::make('itaDitaD'), 'usertype' => 'A'],
            ['username' => 'pazipazi', 'password' => Hash::make('itaDitaD'), 'usertype' => 'P'],
            ['username' => 'clinclin', 'password' => Hash::make('itaDitaD'), 'usertype' => 'C'],
            ['username' => 'peterparker', 'password' => Hash::make('password3'), 'usertype' => 'P'],
            ['username' => 'maryjane', 'password' => Hash::make('password4'), 'usertype' => 'P'],
            ['username' => 'clarkkent', 'password' => Hash::make('password5'), 'usertype' => 'P'],
            ['username' => 'brucewayne', 'password' => Hash::make('password6'), 'usertype' => 'P'],
            ['username' => 'dianaprince', 'password' => Hash::make('password7'), 'usertype' => 'P'],
            ['username' => 'tonystark', 'password' => Hash::make('password17'), 'usertype' => 'C'],
            ['username' => 'natasharomanoff', 'password' => Hash::make('password18'), 'usertype' => 'C'],
            ['username' => 'wandamaximoff', 'password' => Hash::make('password19'), 'usertype' => 'C'],
            ['username' => 'pietromaximoff', 'password' => Hash::make('password20'), 'usertype' => 'C'],
            ['username' => 'scottlang', 'password' => Hash::make('password22'), 'usertype' => 'C'],
        ]);

        DB::table('clinico')->insert([
            [
                'username' => 'tonystark',
                'nome' => 'Tony',
                'cognome' => 'Stark',
                'dataNasc' => '1970-05-29',
                'ruolo' => 'Medico',
                'specializ' => 'Chirurgia Cardiaca'
            ],
            [
                'username' => 'natasharomanoff',
                'nome' => 'Natasha',
                'cognome' => 'Romanoff',
                'dataNasc' => '1984-11-22',
                'ruolo' => 'Medico',
                'specializ' => 'Neurochirurgia'
            ],
            [
                'username' => 'wandamaximoff',
                'nome' => 'Wanda',
                'cognome' => 'Maximoff',
                'dataNasc' => '1989-02-10',
                'ruolo' => 'Fisioterapista',
                'specializ' => 'Riabilitazione Motoria'
            ],
            [
                'username' => 'pietromaximoff',
                'nome' => 'Pietro',
                'cognome' => 'Maximoff',
                'dataNasc' => '1989-02-10',
                'ruolo' => 'Medico',
                'specializ' => 'Pediatria'
            ],
            [
                'username' => 'scottlang',
                'nome' => 'Scott',
                'cognome' => 'Lang',
                'dataNasc' => '1969-07-06',
                'ruolo' => 'Medico',
                'specializ' => 'Chirurgia Generale'
            ],
            [
                'username' => 'clinclin',
                'nome' => 'Luca',
                'cognome' => 'Esposito',
                'data_nasc' => '1980-03-17',
                'ruolo' => 'Fisioterapista',
                'specializ' => 'Riabilitazione Respiratoria'
            ],
            
        ]);

        DB::table('paziente')->insert([
            [
                'username' => 'pazipazi',
                'nome' => 'Martina',
                'cognome' => 'Ricci',
                'dataNasc' => '1980-01-15',
                'genere' => 'F',
                'via' => 'Via Roma',
                'civico' => 10,
                'citta' => 'Milano',
                'prov' => 'MI',
                'telefono' => '3201234567',
                'email' => 'martina.ricci@example.com',
                'clinico' => 'tonystark'
            ],
            [
                'username' => 'dianaprince',
                'nome' => 'Diana',
                'cognome' => 'Prince',
                'dataNasc' => '1982-05-20',
                'genere' => 'F',
                'via' => 'Via Verdi',
                'civico' => 20,
                'citta' => 'Roma',
                'prov' => 'RM',
                'telefono' => '3312345678',
                'email' => 'diana.prince@example.com',
                'clinico' => 'natasharomanoff'
            ],
            [
                'username' => 'peterparker',
                'nome' => 'Peter',
                'cognome' => 'Parker',
                'dataNasc' => '1995-08-10',
                'genere' => 'M',
                'via' => 'Via degli Acero',
                'civico' => 15,
                'citta' => 'New York',
                'prov' => 'NY',
                'telefono' => '3403456789',
                'email' => 'peter.parker@example.com',
                'clinico' => 'wandamaximoff'
            ],
            [
                'username' => 'maryjane',
                'nome' => 'Mary',
                'cognome' => 'Jane',
                'dataNasc' => '1993-03-12',
                'genere' => 'F',
                'via' => 'Via delle Rose',
                'civico' => 5,
                'citta' => 'New York',
                'prov' => 'NY',
                'telefono' => '3454567890',
                'email' => 'mary.jane@example.com',
                'clinico' => 'wandamaximoff'
            ],
            [
                'username' => 'clarkkent',
                'nome' => 'Clark',
                'cognome' => 'Kent',
                'dataNasc' => '1986-07-01',
                'genere' => 'M',
                'via' => '123 Lane',
                'civico' => 1,
                'citta' => 'Metropolis',
                'prov' => 'MP',
                'telefono' => '3475678901',
                'email' => 'clark.kent@example.com',
                'clinico' => 'pietromaximoff'
            ],
            [
                'username' => 'brucewayne',
                'nome' => 'Bruce',
                'cognome' => 'Wayne',
                'dataNasc' => '1980-02-19',
                'genere' => 'M',
                'via' => 'Wayne Manor',
                'civico' => 1007,
                'citta' => 'Gotham',
                'prov' => 'GT',
                'telefono' => '3496789012',
                'email' => 'bruce.wayne@example.com',
                'clinico' => 'scottlang'
            ],
        ]);


    }
}
