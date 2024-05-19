<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistMotorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('distmotorio')->insert([
            ['nome' => 'Distonia Parossistica', 'categoria' => 'Neurologica'],
            ['nome' => 'Atassia Spinocerebellare', 'categoria' => 'Genetica'],
            ['nome' => 'Sclerosi Laterale Amiotrofica', 'categoria' => 'Neurologica'],
            ['nome' => 'Parkinsonismo Idiopatico', 'categoria' => 'Neurologica'],
            ['nome' => 'Corea di Huntington', 'categoria' => 'Genetica'],
            ['nome' => 'Miastenia Gravis', 'categoria' => 'Autoimmune'],
            ['nome' => 'Sindrome delle Gambe senza Riposo', 'categoria' => 'Neurologica'],
            ['nome' => 'Paralisi Cerebrale', 'categoria' => 'Congenita'],
            ['nome' => 'Distrofia Muscolare', 'categoria' => 'Genetica'],
            ['nome' => 'Sindrome di Guillain-Barré', 'categoria' => 'Autoimmune'],
        ]);
    }
}
