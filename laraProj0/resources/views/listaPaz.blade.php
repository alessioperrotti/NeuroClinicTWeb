@extends('layouts.basic')

@section('title', 'Elimina Paziente')

@section('content')

<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Elimina Paziente</h1>
</div>
<div id="app" class="text-lg container mx-auto p-4 w-full max-w-4xl">
    
    <input type="text" id="cognomePaziente" placeholder="Cerca per cognome" class="bg-cyan-50 my-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black text-gray-700 leading-tight focus:outline-none">

    <ul id="listaPazienti" class="mb-4 list-none">
        @isset($pazienti)
            @foreach ($pazienti as $paziente)
                <li class="paziente flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                    <span class="font-bold">{{ $paziente->nome . " " . $paziente->cognome }}</span>
                    <div class="flex mr-2 gap-x-4">
                        <form action="{{ route('eliminaPaziente', $paziente->username) }}" method="POST" class="delete-form">
                            @csrf
                            <button type="submit">
                                <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        @endisset
    </ul>
</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sovrascrive il pulsante "Indietro"
        $(function() {
            elem_id = "back_button";
            rotta = "{{ route('homeAdmin') }}";
            sovrascriviOnClick(elem_id,rotta);
        });

        // Conferma per l'eliminazione del paziente:
        //prendo l'elemento form con classe delete-form e gli aggiungo un gestore degli eventi 
        //quando la form viene inviata eseguo la funzione, se l'utente fa clic su "Annulla", la funzione confirm restituirà false, 
        //(!false=true ed entro nell'if), l'evento di submit viene quindi prevenuto e il paziente non viene eliminato
        document.querySelector('.delete-form').addEventListener('submit', function(event) {
            if (!confirm('Sei sicuro di voler eliminare questo paziente?')) {
                event.preventDefault();
            }
        });
        
        // Filtro per cognome jQuery
        $('#cognomePaziente').on('input', function() { // assegno un gestore di eventi sul campo di input con l'ID cognomePaziente
                                                        //l'evento input si verifica quando il contenuto dell'elemento input cambia.
                var filter = $(this).val().toLowerCase(); //cognome che sto cercando, lo estraggo dall'input 
                $('.paziente').each(function() {        //per ogni elemento con classe "paziente" esguo questa funzione
                    var fullName = $(this).find('span').text().toLowerCase(); //estraggo il nome completo che so essere nell'elemento span
                                                                            // all'interno dell'elemento con classe paziente (l'elemento della lista in questo caso)
                    var cognome = fullName.split(' ').pop(); // Prende l'ultimo elemento come cognome così anche se il paziente ha 2 nomi trova comunque il cognome
                    $(this).toggle(cognome.startsWith(filter)); // Mostra o nasconde il paziente in base al filtro
                });                                             // se per es. cognome.startsWith(filter) restituisce false perchè il cognome 
            }); 
                                                       // non inizia per "filter" con $(this).toggle(false) nascondo l'elemento 
                                                         // preso all'inizio
    });
            
</script>

@endsection
