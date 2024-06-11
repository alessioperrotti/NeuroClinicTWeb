@extends('layouts.basic')

@section('title', 'Inserimento nuovo clinico')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Inserimento nuovo clinico</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
        <form id="formNuovoClinico" action="{{ route('nuovoClinico.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input id= "nome" name="nome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Nome">
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input id= "cognome" name="cognome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Cognome">
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input id= "dataNasc" name="dataNasc" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Data di nascita">
                </div>
                <div>
                    <label class="block text-gray-700">Ruolo</label>
                    <select id= "ruolo" name="ruolo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="medico">Medico</option>
                        <option value="fisioterapia">Fisioterapia</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Specializzazione</label>
                    <input id= "specializ" name="specializ" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Specializzazione">
                </div>
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input id= "username" name="username" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Username">
                </div>
            </div>
            <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                <a href="{{ route('gestioneClinici') }}">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md">Annulla Inserimento</button>
                </a>
                <button type="submit" class="bg-cyan-600 hover:bg-cyan-500 text-white py-2 px-4 rounded-md">Conferma Inserimento</button>
            </div>
        </form>
    </div>
</div>

<!-- JAVA / JQUERY SCRIPT -->
<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {
        // Funzione per impostare la validazione del form
        function setupValidation(actionUrl, formId) {
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
        $(function() {
            var actionUrl = "{{ route('nuovoClinico.store') }}";
            var formId = 'formNuovoClinico';
            setupValidation(actionUrl, formId);
        });
    });
</script>
@endsection