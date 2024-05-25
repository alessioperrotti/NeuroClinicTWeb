@extends('layouts.basic')

@section('title', 'Cartella Paziente')

@section('content')
@isset($paziente)
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Cartella clinica di {{ $paziente->nome . " " . $paziente->cognome }}</h1>
@endisset
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

            @if($farmaci == null)
                <li><p class="font-semibold">Non ci sono farmaci prescritti.</p>
            @endif
            
            @isset($attivita)
                @foreach($attivita as $att)
                <li><p class="font-semibold">{{ $att->nome}}</p>
                    <p class="text-gray-500">{{ $att->descr}}</p>
                @endforeach
            @endisset

            @if($attivita == null)
                <li><p class="font-semibold">Non ci sono attvità pianificate.</p>
            @endif
        </ul>
    </div>
    <a href="{{ route('modificaTerapia')}}">
        <button type="button" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500">
            Modifica Terapia
        </button>
    </a>
</div>
<hr class="h-1 my-10 bg-cyan-600 m-28">
<h2 class="text-3xl font-bold ml-5 mt-5 mb-8">Episodi registrati</h2>
<div class="flex mx-[15%] justify-between">
    <div name="filtro1" class="space-x-2 flex items-center">
        <p class="h-min text-lg font-semibold">Filtra per disturbo: </p>

        <!-- help needed -->
        <select name="filtroDisturbo" multiple class="inline bg-white rounded-md h-min w-min p-1 border border-cyan-600" size=1>
            @isset($disturbi)
                @foreach($disturbi as $disturbo)
                <option value="{{ $disturbo->nome}}">{{ $disturbo->nome}}</option>
                @endforeach
            @endisset

            @if($disturbi == null)
                <li><p class="font-semibold">Non ci sono disturbi diagnosticati.</p>
            @endif
        </select>
    </div>
    <div name="filtro2" class="space-x-2 flex items-center">
        <p class="text-lg font-semibold">Filtra per intensità:</p>
        <div class="flex space-x-1 items-center">
            <p>min</p>
            <select name="filtroMin" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
        <div class="flex space-x-1 items-center">
            <p>max</p>
            <select name="filtroMax" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
    </div>
</div>
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <input type="text" name="nomeDisturbo" placeholder="Cerca per nome del disturbo" 
    class=" bg-cyan-50 my-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black
    text-gray-700 leading-tight  focus:outline-none" >

    @isset($episodi)
    @foreach ($episodi as $episodio)
    <!-- ho messo padding a 4 invece che a 2 (eventualmente cambiare anche su admin) -->
        
        <div class="flex justify-between items-center bg-white p-4 rounded-lg mb-2">
            <span class="font-bold">{{ $episodio->nome }}</span>
            <div class="flex mr-2 gap-x-4">
                <a href="{{ route('cartellaClin2')}}">
                    <img src="{{ asset('images/cartella_clinica.png') }}" alt="Modifica" class="h-10 inline-block">
                </a>
            </div>
        </div>

    @endforeach
    @endisset

    @if($episodi == null)
        <li><p class="font-semibold">Non ci sono episodi segnalati.</p>
    @endif

</div>
@endsection