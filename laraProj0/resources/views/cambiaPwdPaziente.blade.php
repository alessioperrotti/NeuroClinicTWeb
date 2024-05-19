@extends('layouts.basic')

@section('title', 'Cambia Password')

@section('content')
<h1 class="text-black font-bold text-5xl mx-8 mt-4">Modifica password</h1>
<div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">
    <form class="mb-10">
        <label class="text-black font-semibold text-xl ">Vecchia Password</label>
        <br>
        <input type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2"></inpunt>
        <br>
        <label class="text-black font-semibold text-xl ">Nuova Password</label>
        <br>
        <input type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2"></inpunt>
        <br>
        <label class="text-black font-semibold text-xl ">Conferma Nuova Password</label>
        <br>
        <input type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2"></inpunt>
        <div class="mx-56 my-4">
            <input id="annulla" type="submit" value="Annulla" class="cursor-pointer float-left bg-cyan-600 rounded-md py-1 px-2 text-white text-lg hover:bg-cyan-500 w-28" ></input>
            <input id="conferma" type="submit" value="Conferma" class="cursor-pointer float-right bg-cyan-600 rounded-md py-1 px-2 text-white text-lg hover:bg-cyan-500 w-28"></input>
        </div>
    </form>
</div>
@endsection