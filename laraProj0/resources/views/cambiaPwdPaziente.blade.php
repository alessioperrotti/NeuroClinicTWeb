@extends('layouts.basic')

@section('title', 'Cambia Password')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-black font-bold text-5xl mx-8 mt-4">Modifica password</h1>
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">
        <form class="mb-10">    
            <label class="block text-gray-700 font-semibold text-xl">Vecchia Password</label>
            <input name="vecchiaPwd" type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2 hover:"></inpunt>
            <label class="block text-gray-700 font-semibold text-xl">Nuova Password</label>
            <input name="nuovaPwd" type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2"></inpunt>
            <label class="block text-gray-700 font-semibold text-xl">Conferma Nuova Password</label>
            <input name="confermaPwd" type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2"></inpunt>
            <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                <input name="annulla" type="reset" value="Annulla Modifiche" class="cursor-pointer bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400" ></input>
                <input name="conferma" type="submit" value="Conferma Modifiche" class="cursor-pointer bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500"></input>
            </div>
        </form>
    </div>
</div>
@endsection