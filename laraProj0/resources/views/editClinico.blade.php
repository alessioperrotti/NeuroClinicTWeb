@extends('layouts.basic')

@section('title', 'Modifica clinico')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Modifica clinico {{$clinico->nome . " " . $clinico->cognome}}</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
        <form action="{{ route('aggiornaClinico.edit', $clinico->username) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input name="nome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->nome}}>
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input name="cognome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->cognome}}>
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input name="dataNasc" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->dataNasc}}>
                </div>
                <div>
                    <label class="block text-gray-700">Ruolo</label>
                    <input name="ruolo" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->ruolo}}>
                </div>
                <div>
                    <label class="block text-gray-700">Specializzazione</label>
                    <input name="specializ" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->specializ}}>
                </div>
            </div>
            <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                <a href="{{ route('gestioneClinici') }}">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md">Annulla Modifica</button>
                </a>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Conferma Modifica</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sovrascrive il pulsante "Indietro"
        //Prendo l'elemento con Id=back_button, a questo elemento sovrascrivo  
        //l'attributo onclick in modo che quando viene cliccato eseguo la funzione
        //che imposta window.location.href sulla route {{ route('gestioneClinici') }} (window.location.href è una proprietà in JavaScript che rappresenta l'URL della pagina corrente)
        var backButton = document.getElementById('back_button');
        backButton.onclick = function() {
            window.location.href = "{{ route('gestioneClinici') }}";
        };
    });                                                 
</script>

@endsection