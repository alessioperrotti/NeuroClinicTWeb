@extends('layouts.basic')
@section('title', 'Cartella Paziente')

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Storico terapie di {{$paziente->nome . " " . $paziente->cognome}}</h1>
<div class="flex flex-col items-center">

    @isset($terAssoc)
    @foreach($terAssoc as $terapia)
    <div name="container_terapia" class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8 w-[950px]">
        <h3 class="text-2xl font-semibold mt-6">Terapia del {{$terapia['dataTer']}}</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($terapia['farmaci'])
                @foreach($terapia['farmaci'] as $farmaco)   
                <li class="mb-4"><p class="font-semibold">{{ $farmaco['farmaco']->nome ." (". $farmaco['freq'] . ")"}}</p>
                    <p class="text-gray-500">{{ $farmaco['farmaco']->descr}}</p>
                @endforeach
            @endisset

            @if($terapia['farmaci'] == null)
                <li><p class="font-semibold">Non ci sono farmaci prescritti.</p>
            @endif
            
            @isset($terapia['attivita'])
                @foreach($terapia['attivita'] as $att)
                <li class="mb-4"><p class="font-semibold">{{ $att['attivita']->nome ." (". $att['freq'] . ")"}}</p>
                    <p class="text-gray-500">{{ $att['attivita']->descr}}</p>
                @endforeach
            @endisset

            @if($terapia['attivita'] == null)
                <li><p class="font-semibold">Non ci sono attvità pianificate.</p>
            @endif
        </ul>
    </div>
    @endforeach
    @endisset
    
</div>
@endsection