@extends('layouts.basic')

@section('title', 'Inserimento nuovo clinico')

@section('content')


<h1 class="p-10 text-5xl font-bold">Inserimento nuovo clinico</h1>
<div class="flex flex-col items-center justify-center">
    <div class=" bg-gray-200 p-8 rounded-lg shadow-md w-full  max-w-5xl">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-7 gap-x-40">
                <div class="mb-4">
                    <label class="block text-gray-700">Nome</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Nome">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Cognome</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Cognome">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Data di nascita</label>
                    <input type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Data di nascita">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ruolo</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Ruolo">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Specializzazione</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Specializzazione">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Username</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Username">
                </div>
                <div class="mb-4 flex justify-center ">
                    <button type="button" class="bg-cyan-600 text-white py-2 px-4 rounded-md">Annulla Modifiche</button>
                </div>
                <div class="mb-4 flex justify-center">
                    <button type="submit" class="bg-cyan-600 text-white py-2 px-4 rounded-md">Conferma Modifiche</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
