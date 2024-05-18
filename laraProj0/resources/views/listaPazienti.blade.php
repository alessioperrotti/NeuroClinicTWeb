@extends('layouts.basic')

@section('title', 'Lista Pazienti')
<!-- sostituire id con name nell'input di ricerca anche su gestioneClinici-->

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Cartelle cliniche</h1>
</div>
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <input type="text" name="cognomePaziente" placeholder="Cerca per cognome" 
    class=" bg-cyan-50 my-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black
     text-gray-700 leading-tight  focus:outline-none" >

    @isset($pazienti)
    @foreach ($pazienti as $paziente)
    <!-- ho messo padding a 4 invece che a 2 (eventualmente cambiare anche su admin) -->
        
        <div class="flex justify-between items-center bg-white p-4 rounded-lg mb-2">
            <span class="font-bold">{{ $paziente->nome }}</span>
            <div class="flex mr-2 gap-x-4">
                <a href="">
                    <img src="{{ url('images/cartella_clinica.png') }}" alt="Modifica" class="h-10 inline-block">
                </a>
            </div>
        </div>

    @endforeach
    @endisset()
    <!-- da aggiungere clinici -->


    <div class="flex justify-center  mt-10">
        <!-- Bottone per aggiungere un nuovo clinico -->
        <button id="btnAggiungiClinico" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">
            Aggiungi clinico
        </button>
    </div>
    
</div>

@endsection