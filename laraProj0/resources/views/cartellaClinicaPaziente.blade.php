@extends('layouts.basic')
@section('title', 'Cartella Paziente')

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Cartella clinica di @yield('paziente')</h1>
<div class="flex flex-col items-center">
    <div name="container_terapia" class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8">
        <h3 class="text-2xl font-semibold">Disturbi diagnosticati</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($disturbi)
                @foreach($disturbi as $disturbo)
                <li>{{ $disturbo->nome}}
                @endforeach
            @endisset
        </ul>
        <h3 class="text-2xl font-semibold mt-6">Terapia attiva</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($farmaci)
                @foreach($farmaci as $farmaco)   
                <li><p class="font-semibold">{{ $farmaco->nome}}</p>
                    <p class="text-gray-500">{{ $farmaco->descr}}</p>
                @endforeach
            @endisset
            
            @isset($attivita)
                @foreach($attivita as $att)
                <li><p class="font-semibold">{{ $att->nome}}</p>
                    <p class="text-gray-500">{{ $att->descr}}</p>
                @endforeach
            @endisset
        </ul>
    </div>
@endsection