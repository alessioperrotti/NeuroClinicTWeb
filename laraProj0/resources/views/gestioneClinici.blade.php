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
                        <form  method="POST" class="delete-form"> <!-- action="{{ route('eliminaclinico', $clinico->username) }}" -->
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
        $(document).ready(function() {
            // Filtro per cognome jQuery
            $('#cognomeClinico').on('input', function() // assegno un gestore di eventi sul campo di input con l'ID cognomeClinico
            {                                             //l'evento input si verifica quando il contenuto dell'elemento input cambia.
                var filter = $(this).val().toLowerCase(); //cognome che sto cercando, lo estraggo dall'input 
                $('.clinico').each(function() {        //per ogni elemento con classe "clinico" esguo questa funzione
                    var fullName = $(this).find('span').text().toLowerCase(); //estraggo il nome completo che so essere nell'elemento span
                                                                                    // all'interno dell'elemento con classe clinico (l'elemento della lista in questo caso)
                    var cognome = fullName.split(' ').pop(); // Prende l'ultimo elemento come cognome così anche se il clinico ha 2 nomi trova comunque il cognome
                    $(this).toggle(cognome.startsWith(filter)); // Mostra o nasconde il clinico in base al filtro
                });                                             // se per es. cognome.startsWith(filter) restituisce false perchè il cognome 
            });                                                 // non inizia per "filter" con $(this).toggle(false) nascondo l'elemento 
        });                                                     // preso all'inizio
    }); 
</script>
@endsection