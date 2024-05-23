@extends('layouts.basic')

@section('title', 'Inserimento Nuovo Paziente')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Inserimento nuovo paziente</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input name="nome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Nome">
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input name="cognome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Cognome">
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input name="dataNasc" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Data di nascita">
                </div>
                <div>
                    <label class="block text-gray-700">Genere</label>
                    <select name="genere" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="M" class="text-gray-700">Uomo</option>
                        <option value="F" class="text-gray-700">Donna</option>
                        <option value="A" class="text-gray-700">Altro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Via</label>
                    <input name="via" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Indirizzo">
                </div>
                <div>
                    <label class="block text-gray-700">Civico</label>
                    <input name="indirizzo" type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Indirizzo">
                </div>
                <div>
                    <label class="block text-gray-700">Città</label>
                    <input name="citta" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Indirizzo">
                </div>
                <div>
                    <label class="block text-gray-700">Provincia</label>
                    <select name="provincia" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @isset($province)
                        @foreach($province as $provincia)
                            <option value={{$provincia}} class="text-gray-700">{{$provincia}}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Telefono</label>
                    <input name="telefono" type="tel" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700">E-Mail</label>
                    <input name="email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Username">
                </div>
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input name="username" type="text" maxlength="20" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Username">
                </div>   
            </div>
            <div>
                <label class="block text-gray-700">Username</label>
                <input name="username" type="text" maxlength="20" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Username">
            </div>
            <div class="flex justify-center mt-4 gap-y-4 gap-x-24">
                <input type="reset" value="Annulla Modifiche" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400">
                <input type="submit" value="Conferma Modifiche" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500">
            </div>
        </form>
    </div>
</div>
@endsection

<!-- non ha senso usare il tag button con type="button" -->
<!-- per username settare massimo 20 caratteri -->