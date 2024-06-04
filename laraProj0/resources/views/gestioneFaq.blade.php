@extends('layouts.basic')

@section('title', 'Gestione Faq')

@section('content')

<div class="flex justify-center p-4">
    <div class="w-full max-w-lg">
        <div>
            <h1 class="text-5xl font-bold mt-5 mb-8 gap-y-5 text-center">Gestione FAQ</h1>
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
                            <form id="formModificaFaq-{{ $faq->id }}" action="{{ route('faq.update', $faq->id) }}" method="POST">
                                <textarea id="rispostaModifica-{{ $faq->id }}" name="risposta" class="w-full border-2" rows="4">{{$faq->risposta}}</textarea>
                                <input type="hidden" name="domanda" value="{{$faq->domanda}}">
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
        <div class="flex justify-center mt-10">
            <button id="btnAggiungiFaq" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4">Aggiungi Faq</button>
        </div>
        <form id="formNuovaFaq" action="{{ route('faq.store')}}" method="POST" style="display: none;">
            @csrf
            <hr class="h-0.5 my-8 bg-cyan-600 border-0">
            <div class="bg-white p-4 rounded-lg">
                <div class="mb-6 mx-3">
                    <label for="domanda" class="block text-gray-700 text-sm font-bold mb-2">Domanda</label>
                    <input type="text" id="domanda" name="domanda" placeholder="Domanda" class="shadow mb-7 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6 mx-3">
                    <label for="risposta" class="block text-gray-700 text-sm font-bold mb-2">Risposta</label>
                    <textarea id="risposta" name="risposta" placeholder="Risposta" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnulla" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                    <button id="btnAggiungi" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {
        // Funzione per resettare un form e nasconderlo
        function resetForm(formId, fields) {
            // Nasconde il form specificato
            $(formId).hide();
            // Resetta i campi del form
            fields.forEach(field => $(field).val(''));
        }

        // Funzione per alternare la visibilità di due form
        function toggleForms(showFormId, hideFormId) {
            // Mostra il form specificato da showFormId
            $(showFormId).show();
            // Nasconde il form specificato da hideFormId
            $(hideFormId).hide();
        }

        // Funzione per impostare la validazione del form
        function setupValidation(actionUrl, formId, modifica) {
            // Aggiunge un listener per l'evento 'blur' a tutti gli input del form
            $("#" + formId + " :input").on('blur', function() {
                // Ottiene l'ID e il nome dell'input attualmente in focus
                var formElementId = $(this).attr('id');
                var inputName = $(this).attr('name');
                // Chiama la funzione di validazione per l'elemento corrente
                doElemValidation(formElementId, actionUrl, formId, inputName);
            });
            
            // Aggiunge un listener per l'evento 'submit' del form
            $("#" + formId).on('submit', function(event) {
            // Previene l'invio predefinito del form
            event.preventDefault();
            // Chiama la funzione di validazione per l'intero form
            doFormValidation(actionUrl, formId);
            });
        }

        // Funzione per impostare la navigazione del pulsante
        function setupButtonNavigation(buttonId, targetUrl) {
            // Ottiene l'elemento del pulsante tramite ID
            var button = document.getElementById(buttonId);
            if (button) {
                // Imposta l'azione del pulsante per navigare a targetUrl
                button.onclick = function() {
                    window.location.href = targetUrl;
                };
            }
        }

        // Funzione per alternare la visibilità dell'accordion
        function toggleAccordion(element) {
            // Ottiene il contenuto dell'accordion (il div successivo all'elemento cliccato)
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

            // Inizializza la validazione del form quando il documento è pronto
        $(function() {
            var actionUrl = "{{ route('faq.store') }}";
            var formId = 'formNuovaFaq';
            setupValidation(actionUrl, formId, false);
        });

        // Per la validazione della modifica della FAQ con AJAX
        $(function() {
            @isset($faqs)
                @foreach ($faqs as $faq)
                    var actionUrl = "{{ route('faq.update', $faq->id) }}";
                    var formId = 'formModificaFaq-{{ $faq->id }}';
                    setupValidation(actionUrl, formId, true);
                @endforeach
            @endisset
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Sovrascrive il pulsante "Indietro"
            //Prendo l'elemento con Id=back_button, a questo elemento sovrascrivo  
            //l'attributo onclick in modo che quando viene cliccato eseguo la funzione
            //che imposta window.location.href sulla route {{ route('gestioneClinici') }} (window.location.href è una proprietà in JavaScript che rappresenta l'URL della pagina corrente)
            var backButton = document.getElementById('back_button');
            backButton.onclick = function() {
                window.location.href = "{{ route('homeAdmin') }}";
            };
        });  

        // Aggiunge un listener per il pulsante "Aggiungi FAQ" per mostrare il form
        document.getElementById('btnAggiungiFaq').addEventListener('click', function() {
            document.getElementById('formNuovaFaq').style.display = 'block';
            // Scorre fino alla fine della pagina per mostrare il form
            window.scrollTo(0, document.body.scrollHeight);
        });

        // Aggiunge un listener per il pulsante "Annulla" per resettare e nascondere il form
        document.getElementById('btnAnnulla').addEventListener('click', function() {
            resetForm('#formNuovaFaq', ['#domanda', '#risposta']);
        });

        // Assegna il listener per il click a tutti gli elementi accordion
        document.querySelectorAll('.faq > .flex').forEach(function(element) {
            element.addEventListener('click', function() {
                toggleAccordion(this);
            });
        });
    });
</script>
@endsection
