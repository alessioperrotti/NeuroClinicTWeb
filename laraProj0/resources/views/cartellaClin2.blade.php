@extends('layouts.basic')

@section('title', 'Cartella Paziente')

@section('content')

<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Cartella clinica di @yield('paziente')</h1>
<div name="container_terapia" class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8">
    <h3 class="text-2xl font-semibold">Disturbi diagnosticati</h3>
    <hr class="h-0.5 my-2 bg-cyan-600">
    <ul style="list-style-type: disc" class="ml-6">
        @foreach($disturbi as $disturbo)
            <li>{{ $disturbo->nome}}
        @endforeach
    </ul>
    <h3 class="text-2xl font-semibold mt-6">Terapia attiva</h3>
    <hr class="h-0.5 my-2 bg-cyan-600">
    <ul style="list-style-type: disc" class="ml-6">
        @foreach($farmaci as $farmaco)   <!-- si intendono i farmaci assegnati nella terapia -->
            <li><p class="font-semibold">{{ $farmaco->nome}}</p>
                <p class="text-gray-500">{{ $farmaco->descr}}</p>
        @endforeach

        @foreach($attivita as $att)
            <li><p class="font-semibold">{{ $att->nome}}</p>
                <p class="text-gray-500">{{ $att->decsr}}</p>
        @endforeach
    </ul>
</div>
<a href="{{ route('modificaTerapia')}}">
    <button type="button" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500">
        Modifica Terapia
    </button>
</a>
<hr class="h-1 my-10 bg-cyan-600 m-28">
<h2 class="text-3xl font-bold ml-5 mt-5 mb-8">Episodi registrati</h2>
<div class="mx-4 flex justify-between">
    <div name="filtro1">
        <p>Filtra per disturbo: </p>
        <select class="inline h-4 bg-white rounded-sm">
            @foreach($disturbi as $disturbo)
                <option>{{ $disturbo->nome}}</option>
            @endforeach
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