@extends('layouts.basic')

@section('title', 'Cartella Paziente')

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Cartella clinica di @yield('paziente')</h1>
<div class="flex flex-col items-center">
    <div name="container_terapia" class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8">
        <h3 class="text-2xl font-semibold">Disturbi diagnosticati</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            <li>Disturbo 1
            <li>Disturbo 2
            <li>Disturbo 3
        </ul>
        <h3 class="text-2xl font-semibold mt-6">Terapia attiva</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">   
            <li><p class="font-semibold">Xanax 100 mg</p>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum deserunt 
                    facilis dolorum modi! Nihil, ex repudiandae. Soluta autem labore totam.</p>
            
            <li><p class="font-semibold">Xanax 100 mg</p>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam iure illo 
                    reprehenderit quae id delectus praesentium dicta sit voluptate in.</p>
        </ul>
    </div>
    <a href="">
        <button type="button" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500">
            Modifica Terapia
        </button>
    </a>
</div>
<hr class="h-1 my-10 bg-cyan-600 m-28">
<h2 class="text-3xl font-bold ml-5 mt-5 mb-8">Episodi registrati</h2>
<div class="mx-4 flex justify-between">
    <div name="filtro1">
        <p>Filtra per disturbo: </p>
        <select multiple class="inline h-4 bg-white rounded-sm">
            <option>Epilessia mioclonica</option>
            <option>Tetania</option>
            <option>Crisi catatoniche</option>
        </select>
    </div>
    <div name="filtro2" class="space-x-2">
        <p>Filtra per intensità</p>
        <div>
            <p>min</p>
            <input type="text" class="bg-white inline h-4 rounded-sm p-2">
        </div>
        <div>
            <p>max</p>
            <input type="text" class="bg-white inline h-4 rounded-sm p-2">
        </div>
    </div>
</div>

@endsection