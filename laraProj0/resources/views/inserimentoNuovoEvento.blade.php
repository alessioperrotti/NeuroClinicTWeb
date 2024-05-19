@extends('layouts.basic')

@section('title', 'Nuovo Evento')

@section('content')
<h1 class="text-black font-bold text-5xl mx-8 mt-4">Inserimento nuovo evento di <br> disturbo motorio</h1>
<div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">
    <form class="mb-10">
        <label for="disturbo" class="text-black font-semibold text-xl ">Disturbo</label>
        <label for="data" class="text-black font-semibold text-xl float-right mr-52">Data</label>
        <br>
        <select name="disturbo" id="disturbo" size="1" class="border-black border bg-cyan-100 w-64 my-3 rounded-xl pl-2"></select>
        <input name="data" type="date" class="border-black border bg-cyan-100 w-64 my-3 rounded-xl pl-2 float-right"></inpunt>
        <br>
        <label class="text-black font-semibold text-xl ">Ora</label>
        <label class="text-black font-semibold text-xl float-right ">Durata</label>
        <br>
        <input type="time" class="border-black border bg-cyan-100 w-64 my-3 rounded-xl pl-2"></inpunt>
        <input type="number" class="border-black border bg-cyan-100 w-64 my-3 rounded-xl pl-2 float-right"></inpunt>
        <br>
        <label class="text-black font-semibold text-xl ">Intensità</label>
        <br>
        <select size="1" class="border-black border bg-cyan-100 w-64 my-3 rounded-xl pl-2">
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
        <div class="mx-56 my-4">
            <input id="annulla" type="submit" value="Annulla" class="cursor-pointer float-left bg-cyan-600 rounded-md py-1 px-2 text-white text-lg hover:bg-cyan-500 w-28" ></input>
            <input id="conferma" type="submit" value="Conferma" class="cursor-pointer float-right bg-cyan-600 rounded-md py-1 px-2 text-white text-lg hover:bg-cyan-500 w-28"></input>
        </div>
    </form>
</div>
@endsection
