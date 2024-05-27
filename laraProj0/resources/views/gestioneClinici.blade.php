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
               
     <ul id="listaClinici" class="mb-4 list-none">
        @isset($clinici)
            @foreach ($clinici as $clinico)
                <li class="clinico flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                    <span class="font-bold">{{ $clinico->nome . " " . $clinico->cognome }}</span>
                    <div class="flex mr-2 gap-x-4">
                        <button id="btnModifica">
                            <img src="{{ url('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                        </button>
                        <form action="{{ route('clinico.elimina', $clinico->username) }}" method="POST" class="delete-form" onsubmit="return confirm('Sei sicuro di voler eliminare questo clinico?');"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        @endisset
    </ul>

    <div class="flex justify-center  mt-10">
        <!-- Bottone per aggiungere un nuovo clinico -->
        <button id="btnAggiungiClinico" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">
            Aggiungi clinico
        </button>
    </div>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sovrascrive il pulsante "Indietro"
        //Prendo l'elemento con Id=back_button, a questo elemento sovrascrivo  
        //l'attributo onclick in modo che quando viene cliccato eseguo la funzione
        //che imposta window.location.href sulla route {{ route('homeAdmin') }} (window.location.href è una proprietà in JavaScript che rappresenta l'URL della pagina corrente)
        var backButton = document.getElementById('back_button');
        backButton.onclick = function() {
            window.location.href = "{{ route('homeAdmin') }}";
        };
    });                                                 
</script>

@endsection