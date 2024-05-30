@extends('layouts.basic')

@section('title', 'Inserimento nuovo clinico')

@section('content')
@isset($clinico)
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Aggiornamento dati</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder={{$clinico->nome}}>
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder={{$clinico->cognome}}>
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder={{$clinico->dataNasc}}>
                </div>
                <div>
                    <label class="block text-gray-700">Ruolo</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder={{$clinico->ruolo}}>
                </div>
                <div>
                    <label class="block text-gray-700">Specializzazione</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder={{$clinico->specializ}}>
                </div>
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder={{$clinico->username}}>
                </div>
            </div>
            <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                <input type="reset" class="bg-gray-500 text-white py-2 px-4 rounded-md min-w-[100px]">
                <input type="submit" class="bg-cyan-600 text-white py-2 px-4 rounded-md min-w-[100px]">
            </div>
        </form>
    </div>
</div>
@endisset
@endsection
