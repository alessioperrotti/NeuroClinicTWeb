@extends('layouts.basic')
@section('title', 'Aggiornamento Dati Paziente')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-black font-bold text-5xl mx-8 mt-4">Aggiorna dati</h1>
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700 font-semibold">Nome</label>
                    <input name="nome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('nomePaz')>
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input name="cognome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('cognPaz')>
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input name="dataNascita" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('dataPaz')>
                </div>
                <div>
                    <label class="block text-gray-700">Genere</label>
                    <select name="genere" size="1" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('genPaz')>
                        <option value="M">Maschio</option>
                        <option value="F">Femmina</option>
                        <option value="A">Altro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Indirizzo</label>
                    <input name="indirizzo" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('indirPaz')>
                </div>
                <div>
                    <label class="block text-gray-700">Telefono</label>
                    <input name="telefono" type="tel" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('telPaz')>
                </div>
                <div>
                    <label class="block text-gray-700">E-Mail</label>
                    <input name="email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('emailPaz')>
                </div>
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input name="username" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder=@yield('userPaz')>
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