@extends('layouts.basic')

@section('title', 'Gestione clinici')

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione clinici</h1>
</div>
<div id="app" class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <input type="text" id="cognomeClinico" placeholder="Cerca per cognome" 
    class=" bg-cyan-50 my-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black
     text-gray-700 leading-tight  focus:outline-none" >
               
    <form id="listaClinici" class="mb-4">

        <div class="flex justify-between items-center bg-white p-2 rounded-lg mb-2">
            <span class="font-bold">Dottor Bavaro</span>
            <div class="flex mr-2 gap-x-4">
                <button id="btnModifica">
                    <img src="{{ url('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                </button>
                <button id="btnElimina">
                    <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">    
                </button>
            </div>
        </div>
        <!-- da aggiungere clinici -->
    </form>

    <div class="flex justify-center  mt-10">
        <!-- Bottone per aggiungere un nuovo clinico -->
        <button id="btnAggiungiClinico" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">
            Aggiungi clinico
        </button>
    </div>
    
</div>

@endsection