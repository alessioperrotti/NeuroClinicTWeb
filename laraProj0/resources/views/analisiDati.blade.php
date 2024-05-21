@extends('layouts.basic')

@section('content')
<div class='m-4 px-10'>
    <div class='flex justify-center'>
        <h1 class='text-5xl font-bold mx-5 mb-8'>Analisi dei dati</h1>
    </div>

    <div class="flex space-x-10">
        <div class='bg-white text-lg w-1/2 px-5 border rounded border-gray-300 max-h-80 overflow-y-auto'>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Media pazienti per clinico</h2>
                <h2>10</h2>
            </div>
            <hr>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Media disturbi motori registrati per paziente</h2>
                <h2>10</h2>
            </div>
            <hr>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Disturbo motorio</h2>
                <select class="w-1/4">
                    <option>Prova1</option>
                    <option>Prova2</option>
                </select>
            </div>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Numero di eventi totali registrati</h2>
                <h2>10</h2>
            </div>
            <hr>
        </div>

        <div class="w-1/2 border border-gray-300 rounded flex flex-col max-h-80">
            <input class="w-full p-2 border-b border-gray-300 rounded-t" type="text" id="cognomeClinico" placeholder="Cerca per cognome">
            <div class="bg-white overflow-y-auto flex-grow table-container ">
                <table class="min-w-full bg-white">
                    <thead >
                        <tr class="sticky">
                            <th class="px-4 py-2 font-semibold uppercase tracking-wider">Paziente</th>
                            <th class="px-4 py-2 font-semibold uppercase tracking-wider">Numero cambi terapia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">Mario Rossi</td>
                            <td class="px-4 py-2">2</td>
                        </tr>
                        <tr class="border-t border-gray-200 bg-gray-50">
                            <td class="px-4 py-2">Luca Bianchi</td>
                            <td class="px-4 py-2">3</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">Giulia Verdi</td>
                            <td class="px-4 py-2">1</td>
                        </tr>
                        <tr class="border-t border-gray-200 bg-gray-50">
                            <td class="px-4 py-2">Anna Neri</td>
                            <td class="px-4 py-2">4</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">Marco Gialli</td>
                            <td class="px-4 py-2">2</td>
                        </tr>
                        <!-- Aggiungi più righe di esempio -->
                        <tr class="border-t border-gray-200 bg-gray-50">
                            <td class="px-4 py-2">Federico Blu</td>
                            <td class="px-4 py-2">5</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">Elena Viola</td>
                            <td class="px-4 py-2">3</td>
                        </tr>
                        <tr class="border-t border-gray-200 bg-gray-50">
                            <td class="px-4 py-2">Sara Rosa</td>
                            <td class="px-4 py-2">1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title')
Analisi Dati
@endsection
