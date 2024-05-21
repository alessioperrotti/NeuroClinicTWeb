@extends('layouts.basic')

@section('title', 'Nuovo Evento')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-black font-bold text-5xl mx-8 mt-4">Inserimento nuovo evento di disturbo motorio</h1>
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700 font-semibold">Disturbo</label>
                    <select name="disturbo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @isset($diturbo)
                        @foreach($diturbo as $disturbo)
                            <option value="{{ $disturbo->id }}">{{ $disturbo->name }}</option> <!-- Adatta id e name ai tuoi attributi -->
                        @endforeach
                        @endisset
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Data</label>
                    <input name="data" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Ora</label>
                    <input name="ora" type="time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Durata (minuti)</label>
                    <input name="durata" type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Intensità</label>
                    <select name="intensità" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-center mt-8 gap-y-4 4  gap-x-24">
                <input name="annulla" type="reset" value="Annulla Modifiche" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 cursor-pointer"></input>
                <input name="conferma" type="submit" value="Conferma Modifiche" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500 cursor-pointer "></input>
            </div>
        </form>
    </div>
</div>
@endsection


