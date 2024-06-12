@extends('layouts.basic')
@section('title', 'Cartella Paziente')


@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Cartella clinica di {{$paziente->nome . " " . $paziente->cognome}}</h1>
<div class="flex flex-col items-center">
    <div name="container_terapia" class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8 min-w-[800px]">
        <h3 class="text-2xl font-semibold">Disturbi diagnosticati</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($disturbi)
                @foreach($disturbi as $disturbo)
                <li class="mb-4">{{ $disturbo->nome}}
                @endforeach
            @endisset
            @if($disturbi->isEmpty())
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
    <a href="{{ route('terapiePassate')}}">
        <button type="button" class="p-3 bg-cyan-600 mb-8 rounded-lg text-white hover:bg-cyan-500">
            Visualizza Storico Terapie
        </button>
    </a>
</div>
@endsection