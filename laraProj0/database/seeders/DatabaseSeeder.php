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
                'clinico' => 'clinclin'
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
                'clinico' => 'clinclin'
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


        DB::table('distmotorio')->insert([
            [
                'nome' => 'Paralisi cerebrale',
                'categoria' => 'movimento e postura'
            ],
            [
                'nome' => 'Mioclono',
                'categoria' => 'ipercinetici'
            ],
            [
                'nome' => 'Atassia',
                'categoria' => 'coordinazione motoria'
            ],
            [
                'nome' => 'Parkinsonismo',
                'categoria' => 'ipocinetici'
            ],
            ['nome' => 'Distrofia muscolare', 'categoria' => 'distrofie muscolari'],
            ['nome' => 'Corea', 'categoria' => 'movimenti involontari'],
            ['nome' => 'Sindromi piramidali', 'categoria' => 'lesioni piramidali'],
            ['nome' => 'Distonia', 'categoria' => 'distonie'],
            ['nome' => 'Sindrome di Tourette', 'categoria' => 'tourette'],
            ['nome' => 'Sindrome delle gambe senza riposo', 'categoria' => 'sensoriale'],
            ['nome' => 'Tremore essenziale', 'categoria' => 'tremori'],
            ['nome' => 'Sindrome di Guillain-Barré', 'categoria' => 'lesioni nervose'],
            ['nome' => 'Neuropatia periferica', 'categoria' => 'neuropatie'],
            ['nome' => 'Sclerosi laterale amiotrofica', 'categoria' => 'lesioni del motoneurone']
        ]);


        DB::table('farmaco')->insert([
            [
                'nome' => 'Levodopa 100mg',
                'descr' => 'Trattamento principale per il Parkinson, riduce i sintomi motori aumentando i livelli di dopamina nel cervello.'
            ],
            [
                'nome' => 'Carbidopa 25mg',
                'descr' => "Utilizzato in combinazione con Levodopa, previene la sua degradazione prematura, aumentando l'efficacia terapeutica."
            ],
            [
                'nome' => 'Baclofen 10mg',
                'descr' => "Rilassante muscolare usato per alleviare spasmi muscolari, crampi e rigidità associati a disturbi neurologici."
            ],
            [
                'nome' => 'Gabapentin 300mg',
                'descr' => "Anticonvulsivante e analgesico per il trattamento di neuropatie, dolore neuropatico e alcune forme di epilessia."
            ],
            [
                'nome' => 'Dantrolene 25mg',
                'descr' => "Utilizzato per il trattamento della spasticità muscolare, agisce direttamente sul muscolo scheletrico per ridurre la contrazione."
            ],
            [
                'nome' => 'Diazepam 5mg',
                'descr' => "Benzodiazepina che allevia ansia, spasmi muscolari e convulsioni, oltre a essere usata come sedativo."
            ],
            [
                'nome' => 'Tolcapone 100mg',
                'descr' => "Inibitore della COMT che prolunga l'effetto della Levodopa nel trattamento del Parkinson, migliorando la gestione dei sintomi."
            ],
            [
                'nome' => 'Ropinirole 0.25mg',
                'descr' => "Agonista della dopamina usato per trattare i sintomi del Parkinson e la sindrome delle gambe senza riposo."
            ],
            [
                'nome' => 'Pramipexole 0.125mg',
                'descr' => "Agonista della dopamina efficace nel trattamento del Parkinson e della sindrome delle gambe senza riposo, migliorando il controllo motorio."
            ],
            [
                'nome' => 'Tizanidine 2mg',
                'descr' => "Rilassante muscolare che tratta spasmi muscolari causati da sclerosi multipla, lesioni spinali e altre condizioni."
            ]
        ]);


        DB::table('attivita')->insert([
            [
                'nome' => 'Fisioterapia',
                'descr' => 'Trattamento riabilitativo che utilizza esercizi fisici per migliorare la mobilità e ridurre il dolore nei pazienti con disturbi motori.'
            ],
            [
                'nome' => 'Terapia Occupazionale',
                'descr' => 'Attività che aiuta i pazienti a migliorare le abilità motorie necessarie per le attività quotidiane e l\'indipendenza.'
            ],
            [
                'nome' => 'Idroterapia',
                'descr' => 'Terapia che utilizza l\'acqua per facilitare i movimenti, ridurre la spasticità e migliorare la forza muscolare.'
            ],
            [
                'nome' => 'Terapia con Onde d\'Urto',
                'descr' => 'Utilizza onde acustiche per stimolare la rigenerazione dei tessuti e ridurre il dolore nei disturbi muscoloscheletrici.'
            ],
            [
                'nome' => 'Esercizi di Equilibrio',
                'descr' => 'Programmi specifici di esercizi per migliorare l\'equilibrio e ridurre il rischio di cadute nei pazienti con disturbi motori.'
            ],
            [
                'nome' => 'Terapia Manuale',
                'descr' => 'Interventi pratici eseguiti da fisioterapisti per mobilizzare articolazioni e tessuti molli, migliorando la funzione motoria.'
            ],
            [
                'nome' => 'Riabilitazione Robotica',
                'descr' => 'Utilizzo di dispositivi robotici per supportare e migliorare il recupero dei movimenti nei pazienti con deficit motori.'
            ],
            [
                'nome' => 'Elettrostimolazione',
                'descr' => 'Applicazione di correnti elettriche per stimolare i muscoli, migliorare la forza e ridurre la spasticità.'
            ],
            [
                'nome' => 'Terapia Cognitivo-Motoria',
                'descr' => 'Combina esercizi cognitivi e fisici per migliorare la coordinazione motoria e le funzioni cognitive nei pazienti.'
            ],
            [
                'nome' => 'Yoga Terapeutico',
                'descr' => 'Utilizzo di posture, respirazione e meditazione per migliorare la flessibilità, la forza e il benessere generale nei pazienti con disturbi motori.'
            ]
        ]);

        
        DB::table('episodio')->insert([
            [
                'data' => '2023-01-15',
                'ora' => '08:30:00',
                'durata' => 30,
                'intensita' => 5,
                'paziente' => 'pazipazi',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-02-20',
                'ora' => '14:00:00',
                'durata' => 45,
                'intensita' => 7,
                'paziente' => 'dianaprince',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-03-12',
                'ora' => '10:15:00',
                'durata' => 20,
                'intensita' => 4,
                'paziente' => 'peterparker',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-04-05',
                'ora' => '09:45:00',
                'durata' => 60,
                'intensita' => 8,
                'paziente' => 'maryjane',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-05-22',
                'ora' => '11:30:00',
                'durata' => 35,
                'intensita' => 6,
                'paziente' => 'clarkkent',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-06-14',
                'ora' => '15:00:00',
                'durata' => 40,
                'intensita' => 5,
                'paziente' => 'brucewayne',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-07-09',
                'ora' => '08:00:00',
                'durata' => 50,
                'intensita' => 7,
                'paziente' => 'pazipazi',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-08-21',
                'ora' => '12:45:00',
                'durata' => 30,
                'intensita' => 4,
                'paziente' => 'dianaprince',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-09-10',
                'ora' => '09:30:00',
                'durata' => 25,
                'intensita' => 6,
                'paziente' => 'peterparker',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-10-03',
                'ora' => '14:15:00',
                'durata' => 55,
                'intensita' => 8,
                'paziente' => 'maryjane',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-11-19',
                'ora' => '10:45:00',
                'durata' => 60,
                'intensita' => 7,
                'paziente' => 'clarkkent',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-12-01',
                'ora' => '08:15:00',
                'durata' => 40,
                'intensita' => 5,
                'paziente' => 'brucewayne',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-01-25',
                'ora' => '11:00:00',
                'durata' => 30,
                'intensita' => 4,
                'paziente' => 'pazipazi',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-02-15',
                'ora' => '13:00:00',
                'durata' => 45,
                'intensita' => 7,
                'paziente' => 'dianaprince',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-03-22',
                'ora' => '10:30:00',
                'durata' => 20,
                'intensita' => 6,
                'paziente' => 'peterparker',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-04-12',
                'ora' => '09:15:00',
                'durata' => 60,
                'intensita' => 9,
                'paziente' => 'maryjane',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-05-28',
                'ora' => '11:45:00',
                'durata' => 35,
                'intensita' => 8,
                'paziente' => 'clarkkent',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-06-18',
                'ora' => '15:15:00',
                'durata' => 50,
                'intensita' => 6,
                'paziente' => 'brucewayne',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-07-19',
                'ora' => '08:30:00',
                'durata' => 45,
                'intensita' => 7,
                'paziente' => 'pazipazi',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-08-30',
                'ora' => '12:30:00',
                'durata' => 30,
                'intensita' => 5,
                'paziente' => 'dianaprince',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-09-22',
                'ora' => '09:00:00',
                'durata' => 25,
                'intensita' => 6,
                'paziente' => 'peterparker',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-10-15',
                'ora' => '14:45:00',
                'durata' => 55,
                'intensita' => 8,
                'paziente' => 'maryjane',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-11-29',
                'ora' => '10:00:00',
                'durata' => 60,
                'intensita' => 9,
                'paziente' => 'clarkkent',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-12-12',
                'ora' => '08:45:00',
                'durata' => 40,
                'intensita' => 5,
                'paziente' => 'brucewayne',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-01-30',
                'ora' => '11:15:00',
                'durata' => 30,
                'intensita' => 4,
                'paziente' => 'pazipazi',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-02-25',
                'ora' => '13:15:00',
                'durata' => 45,
                'intensita' => 7,
                'paziente' => 'dianaprince',
                'disturbo' => 'Mioclono'
            ],
            [
                'data' => '2023-03-29',
                'ora' => '10:45:00',
                'durata' => 20,
                'intensita' => 6,
                'paziente' => 'peterparker',
                'disturbo' => 'Atassia'
            ],
            [
                'data' => '2023-04-20',
                'ora' => '09:30:00',
                'durata' => 60,
                'intensita' => 9,
                'paziente' => 'maryjane',
                'disturbo' => 'Parkinsonismo'
            ],
            [
                'data' => '2023-05-30',
                'ora' => '11:30:00',
                'durata' => 35,
                'intensita' => 8,
                'paziente' => 'clarkkent',
                'disturbo' => 'Paralisi cerebrale'
            ],
            [
                'data' => '2023-06-25',
                'ora' => '15:30:00',
                'durata' => 50,
                'intensita' => 6,
                'paziente' => 'brucewayne',
                'disturbo' => 'Mioclono'
            ]
        ]);


        DB::table('terapia')->insert([
            [
                'data' => '2023-01-01',
                'paziente' => 'pazipazi'
            ],
            [
                'data' => '2023-01-15',
                'paziente' => 'dianaprince'
            ],
            [
                'data' => '2023-02-01',
                'paziente' => 'peterparker'
            ],
            [
                'data' => '2023-02-15',
                'paziente' => 'maryjane'
            ],
            [
                'data' => '2023-03-01',
                'paziente' => 'clarkkent'
            ],
            [
                'data' => '2023-03-15',
                'paziente' => 'brucewayne'
            ],
            [
                'data' => '2023-04-01',
                'paziente' => 'pazipazi'
            ],
            [
                'data' => '2023-04-15',
                'paziente' => 'dianaprince'
            ],
            [
                'data' => '2023-05-01',
                'paziente' => 'peterparker'
            ],
            [
                'data' => '2023-05-15',
                'paziente' => 'maryjane'
            ],
            [
                'data' => '2023-06-01',
                'paziente' => 'clarkkent'
            ],
            [
                'data' => '2023-06-15',
                'paziente' => 'brucewayne'
            ],
            [
                'data' => '2023-07-01',
                'paziente' => 'pazipazi'
            ],
            [
                'data' => '2023-07-15',
                'paziente' => 'dianaprince'
            ],
            [
                'data' => '2023-08-01',
                'paziente' => 'peterparker'
            ],
            [
                'data' => '2023-08-15',
                'paziente' => 'maryjane'
            ],
            [
                'data' => '2023-09-01',
                'paziente' => 'clarkkent'
            ],
            [
                'data' => '2023-09-15',
                'paziente' => 'brucewayne'
            ],
            [
                'data' => '2023-10-01',
                'paziente' => 'pazipazi'
            ],
            [
                'data' => '2023-10-15',
                'paziente' => 'dianaprince'
            ]
        ]);


        DB::table('prescrizione')->insert([
            ['freq' => '1 volta al giorno', 'terapia' => 1, 'farmaco' => 1],
            ['freq' => '2 volte al giorno', 'terapia' => 2, 'farmaco' => 2],
            ['freq' => '1 volta al giorno', 'terapia' => 3, 'farmaco' => 3],
            ['freq' => '3 volte al giorno', 'terapia' => 4, 'farmaco' => 4],
            ['freq' => '1 volta al giorno', 'terapia' => 5, 'farmaco' => 5],
            ['freq' => '2 volte al giorno', 'terapia' => 6, 'farmaco' => 6],
            ['freq' => '1 volta al giorno', 'terapia' => 7, 'farmaco' => 7],
            ['freq' => '3 volte al giorno', 'terapia' => 8, 'farmaco' => 8],
            ['freq' => '1 volta al giorno', 'terapia' => 9, 'farmaco' => 9],
            ['freq' => '2 volte al giorno', 'terapia' => 10, 'farmaco' => 10],
            ['freq' => '1 volta al giorno', 'terapia' => 11, 'farmaco' => 1],
            ['freq' => '3 volte al giorno', 'terapia' => 12, 'farmaco' => 2],
            ['freq' => '1 volta al giorno', 'terapia' => 13, 'farmaco' => 3],
            ['freq' => '2 volte al giorno', 'terapia' => 14, 'farmaco' => 4],
            ['freq' => '1 volta al giorno', 'terapia' => 15, 'farmaco' => 5],
            ['freq' => '3 volte al giorno', 'terapia' => 16, 'farmaco' => 6],
            ['freq' => '1 volta al giorno', 'terapia' => 17, 'farmaco' => 7],
            ['freq' => '2 volte al giorno', 'terapia' => 18, 'farmaco' => 8],
            ['freq' => '1 volta al giorno', 'terapia' => 19, 'farmaco' => 9],
            ['freq' => '3 volte al giorno', 'terapia' => 20, 'farmaco' => 10],
        ]);


        DB::table('pianificazione')->insert([
            ['freq' => '2 volte a settimana', 'terapia' => 1, 'attivita' => 1],
            ['freq' => '3 volte a settimana', 'terapia' => 2, 'attivita' => 2],
            ['freq' => '1 volta a settimana', 'terapia' => 3, 'attivita' => 3],
            ['freq' => '4 volte a settimana', 'terapia' => 4, 'attivita' => 4],
            ['freq' => '5 volte a settimana', 'terapia' => 5, 'attivita' => 5],
            ['freq' => '6 volte a settimana', 'terapia' => 6, 'attivita' => 6],
            ['freq' => '7 volte a settimana', 'terapia' => 7, 'attivita' => 7],
            ['freq' => '2 volte a settimana', 'terapia' => 8, 'attivita' => 8],
            ['freq' => '3 volte a settimana', 'terapia' => 9, 'attivita' => 9],
            ['freq' => '1 volta a settimana', 'terapia' => 10, 'attivita' => 10],
            ['freq' => '4 volte a settimana', 'terapia' => 11, 'attivita' => 1],
            ['freq' => '5 volte a settimana', 'terapia' => 12, 'attivita' => 2],
            ['freq' => '6 volte a settimana', 'terapia' => 13, 'attivita' => 3],
            ['freq' => '7 volte a settimana', 'terapia' => 14, 'attivita' => 4],
            ['freq' => '2 volte a settimana', 'terapia' => 15, 'attivita' => 5],
            ['freq' => '3 volte a settimana', 'terapia' => 16, 'attivita' => 6],
            ['freq' => '1 volta a settimana', 'terapia' => 17, 'attivita' => 7],
            ['freq' => '4 volte a settimana', 'terapia' => 18, 'attivita' => 8],
            ['freq' => '5 volte a settimana', 'terapia' => 19, 'attivita' => 9],
            ['freq' => '6 volte a settimana', 'terapia' => 20, 'attivita' => 10],
        ]);
        
        
        DB::table('diagnosi')->insert([
            ['paziente' => 'pazipazi', 'disturbo' => 'Parkinsonismo', 'data' => '2023-01-01'],
            ['paziente' => 'dianaprince', 'disturbo' => 'Distonia', 'data' => '2023-02-01'],
            ['paziente' => 'peterparker', 'disturbo' => 'Atassia', 'data' => '2023-03-01'],
            ['paziente' => 'maryjane', 'disturbo' => 'Mioclono', 'data' => '2023-04-01'],
            ['paziente' => 'clarkkent', 'disturbo' => 'Sclerosi laterale amiotrofica', 'data' => '2023-05-01'],
            ['paziente' => 'brucewayne', 'disturbo' => 'Parkinsonismo', 'data' => '2023-06-01'],
            ['paziente' => 'pazipazi', 'disturbo' => 'Distonia', 'data' => '2023-07-01'],
            ['paziente' => 'dianaprince', 'disturbo' => 'Atassia', 'data' => '2023-08-01'],
            ['paziente' => 'peterparker', 'disturbo' => 'Mioclono', 'data' => '2023-09-01'],
            ['paziente' => 'maryjane', 'disturbo' => 'Sclerosi laterale amiotrofica', 'data' => '2023-10-01'],
            ['paziente' => 'clarkkent', 'disturbo' => 'Parkinsonismo', 'data' => '2023-11-01'],
            ['paziente' => 'brucewayne', 'disturbo' => 'Distonia', 'data' => '2023-12-01'],
            ['paziente' => 'pazipazi', 'disturbo' => 'Atassia', 'data' => '2024-01-01'],
            ['paziente' => 'dianaprince', 'disturbo' => 'Mioclono', 'data' => '2024-02-01'],
            ['paziente' => 'peterparker', 'disturbo' => 'Sclerosi laterale amiotrofica', 'data' => '2024-03-01'],
            ['paziente' => 'maryjane', 'disturbo' => 'Parkinsonismo', 'data' => '2024-04-01'],
            ['paziente' => 'clarkkent', 'disturbo' => 'Distonia', 'data' => '2024-05-01'],
            ['paziente' => 'brucewayne', 'disturbo' => 'Atassia', 'data' => '2024-06-01'],
            ['paziente' => 'pazipazi', 'disturbo' => 'Mioclono', 'data' => '2024-07-01'],
            ['paziente' => 'dianaprince', 'disturbo' => 'Sclerosi laterale amiotrofica', 'data' => '2024-08-01'],
            ['paziente' => 'peterparker', 'disturbo' => 'Parkinsonismo', 'data' => '2024-09-01'],
            ['paziente' => 'maryjane', 'disturbo' => 'Distonia', 'data' => '2024-10-01'],
            ['paziente' => 'clarkkent', 'disturbo' => 'Atassia', 'data' => '2024-11-01'],
            ['paziente' => 'brucewayne', 'disturbo' => 'Mioclono', 'data' => '2024-12-01'],
            ['paziente' => 'pazipazi', 'disturbo' => 'Sclerosi laterale amiotrofica', 'data' => '2025-01-01'],
        ]);
        
    }
}
