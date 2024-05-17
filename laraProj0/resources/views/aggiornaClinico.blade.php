@extends('layouts.basic')

@section('title', 'Inserimento nuovo clinico')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Aggiornamento dati</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('nomeClin')>
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('cognClin')>
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('dataClin')>
                </div>
                <div>
                    <label class="block text-gray-700">Ruolo</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('ruoloClin')>
                </div>
                <div>
                    <label class="block text-gray-700">Specializzazione</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('specClin')>
                </div>
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('userClin')>
                </div>
            </div>
            <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md">Annulla Modifiche</button>
                <button type="submit" class="bg-cyan-600 text-white py-2 px-4 rounded-md">Conferma Modifiche</button>
            </div>
        </form>
    </div>
</div>
@endsection