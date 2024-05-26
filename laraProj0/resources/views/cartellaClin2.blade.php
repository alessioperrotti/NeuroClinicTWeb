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
                <li class="mb-4">{{ $disturbo->nome}}
                @endforeach
            @endisset
            @if($disturbi == null)
                <li ><p class="font-semibold">Non ci sono disturbi diagnosticati.</p>
            @endif
        </ul>
        <h3 class="text-2xl font-semibold mt-6">Terapia attiva</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($farmaci)
                @foreach($farmaci as $farmaco)   
                <li class="mb-4"><p class="font-semibold">{{ $farmaco['farmaco']->nome ." (". $farmaco['freq'] . ")"}}</p>
                    <p class="text-gray-500">{{ $farmaco['farmaco']->descr}}</p>
                @endforeach
            @endisset

            @if($farmaci == null)
                <li><p class="font-semibold">Non ci sono farmaci prescritti.</p>
            @endif
            
            @isset($attivita)
                @foreach($attivita as $att)
                <li class="mb-4"><p class="font-semibold">{{ $att['attivita']->nome ." (". $att['freq'] . ")"}}</p>
                    <p class="text-gray-500">{{ $att['attivita']->descr}}</p>
                @endforeach
            @endisset

            @if($attivita == null)
                <li><p class="font-semibold">Non ci sono attvità pianificate.</p>
            @endif
        </ul>
    </div>
    <a href="{{ route('modificaTerapia', ['userPaz' => $paziente->username])}}">
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

        <select name="filtroDisturbo[]" multiple class="inline bg-white rounded-md h-min w-min p-1 border border-cyan-600" size=2>
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
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl mt-6">

    @isset($episodi)
    @foreach ($episodi as $episodio)
        <div class="flex justify-between items-center bg-white p-4 rounded-lg mb-2">
            <p class="font-bold">{{ $episodio->disturbo }}</p>
            <p class="text-gray-500">del {{$episodio->data}} alle {{$episodio->ora}}</p>
        </div>
    @endforeach
    @endisset

    @if($episodi == null)
        <li><p class="font-semibold">Non ci sono episodi segnalati.</p>
    @endif

</div>
@endsection