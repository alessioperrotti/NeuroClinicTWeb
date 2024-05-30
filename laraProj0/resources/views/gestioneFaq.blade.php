@extends('layouts.basic')

@section('title', 'Gestione Faq')

@section('content')

<div class="flex justify-center p-4">
    <div class="w-full max-w-lg">
        <div>
            <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5 text-center">Gestione FAQ</h1>
        </div>
        <ul id="listaFaq" class="mb-4 list-none">
            @isset($faqs)
                @foreach ($faqs as $faq)
                    <li class="faq bg-white p-4 rounded-lg shadow-md mb-2">
                        <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion(this)">
                            <h2 class="text-base font-semibold">{{$faq->domanda}}</h2>
                            <span class="text-xl">+</span>
                        </div>
                        <div class="accordion-content mt-2 hidden">
                            <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                                <textarea name="risposta" class="w-full border-2" rows="4">{{$faq->risposta}}</textarea>
                                <div class="flex gap-2 mt-2">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded mt-2">Salva nuova risposta</button>
                            </form>
                                <form action="{{ route('faq.elimina', $faq->id) }}" method="POST" class="delete-form inline-block" onsubmit="return confirm('Sei sicuro di voler eliminare questa FAQ?');">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded mt-2">Elimina Faq</button>
                                </form>
                                </div>
                        </div>
                    </li>
                @endforeach
            @endisset
        </ul>
        <div class="flex justify-center  mt-10">
                <!-- Bottone per aggiungere un nuova Faq -->
                <button id="btnAggiungiFaq" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">Aggiungi Faq</button>
        </div>
    
        
        <!-- Contenitore per il form di inserimento nuova FAQ , inizialmente nascosto -->
        <form id="formNuovaFaq" action="{{ route('gestioneFaq.store')}}" method="POST" style="display: none;">
            @csrf
            <hr class="h-0.5 my-8 bg-cyan-600 border-0">
            <div class="bg-white p-4 rounded-lg">
                <div class="mb-6 mx-3">
                    <label for="domanda" class="block text-gray-700 text-sm font-bold mb-2">Domanda</label>
                    <input type="text" id="domanda" name="domanda" placeholder="Domanda" class="shadow mb-7 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6 mx-3">
                    <label for="risposta" class="block text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="risposta" name="risposta" placeholder="Risposta" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button id="btnAnnullaInserimento" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sovrascrive il pulsante "Indietro"
        var backButton = document.getElementById('back_button');
        if (backButton) {
            backButton.onclick = function() {
                window.location.href = "{{ route('homeAdmin') }}";
            };
        }
    });
    //AGGIUNTA Faq
    document.getElementById('btnAggiungiFaq').addEventListener('click', function() {
            // Mostra la form di inserimento nuovo Faq
            document.getElementById('formNuovaFaq').style.display = 'block';
            window.scrollTo(0, document.body.scrollHeight); //così scorro a fine pagina
        });

    document.getElementById('btnAnnullaInserimento').addEventListener('click', function() {
        // Nasconde la form e resetta i campi
        document.getElementById('formNuovaFaq').style.display = 'none';
        document.getElementById('domanda').value = '';
        document.getElementById('risposta').value = '';
    });
    function toggleAccordion(element) {
        // Ottiene il prossimo elemento fratello dell'elemento cliccato, che è il div successivo
        const content = element.nextElementSibling;
        // Ottiene l'elemento span figlio dell'elemento cliccato
        const span = element.querySelector('span');
        
        // Controlla se il contenuto dell'accordion è nascosto
        if (content.classList.contains('hidden')) {
            // Se è nascosto, rimuove la classe 'hidden' per mostrarlo
            content.classList.remove('hidden');
            // Cambia il testo del span a "-" per indicare che l'accordion è aperto
            span.textContent = "-";
        } else {
            // Se è visibile, aggiunge la classe 'hidden' per nasconderlo
            content.classList.add('hidden');
            // Cambia il testo del span a "+" per indicare che l'accordion è chiuso
            span.textContent = "+";
        }
    }
</script>

@endsection
