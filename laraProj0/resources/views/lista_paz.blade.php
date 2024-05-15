@extends('layouts.basic')

@section('title', 'Inserimento nuovo clinico')

@section('content')

<h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Elimina Paziente</h1>

<div id="app" class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <div id="listaPazienti" class="mb-4">

        <div class="flex justify-between items-center bg-white p-2 rounded-lg mb-2">
            <span class="font-bold">Mario Rossi</span>
            <div class="flex mr-2 gap-x-4">
                
                <button id="btnElimina">
                    <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">    
                </button>
            </div>
        </div>
        <!-- da aggiungere pazienti -->
    </div>

   

    <!-- Contenitore per il form di inserimento nuovo disturbo, inizialmente nascosto -->
    
</div>



@endsection