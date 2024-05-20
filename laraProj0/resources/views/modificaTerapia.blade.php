@extends('layouts.basic')

@section('title', 'Modifica Terapia')

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Modifica terapia di @yield('paziente')</h1>
<div class="flex justify-center space-x-20">
    <div class="bg-white rounded-xl shadow-md h-auto min-w-[400px] px-6 justify-center">
        <h3 class="my-4 font-bold text-xl text-center">Farmaci</h3>
        <?php $farmaci = ["Farmaco1", "Farmaco2", "Farmaco3"] ?>
        @isset($farmaci)
        <div class="flex-col mb-4">
            <ul style="list-style-type: disc" class="ml-6">
            @foreach($farmaci as $farmaco)
            <li class="mb-2">
            <div class="space-x-4">
                <label class="text-base text-gray-800">{{ $farmaco}}</label>
                <input id="freqCheckId1" type="checkbox" name="farmaco" value="{{ $farmaco}}">
            </div>
            <div id="freqDivId1" class="flex-row space-x-1 hidden">
                <select name="nvolteF" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <p>volte/a al giorno</p>   
            </div>
            </li>
            @endforeach
            </ul>
        </div>
        @endisset
    </div>
    <div class="bg-white rounded-xl shadow-md h-auto min-w-[400px] px-6 justify-center">
        <h3 class="my-4 font-bold text-xl text-center">Attività Riabilitative</h3>
        <?php $farmaci = ["Farmaco1", "Farmaco2", "Farmaco3"] ?>
        @isset($farmaci)
        <div class="flex-col mb-4">
            <ul style="list-style-type: disc" class="ml-6">
            @foreach($farmaci as $farmaco)
            <li class="mb-2">
                <div class="space-x-4">
                <label class="text-base text-gray-800">{{ $farmaco}}</label>
                <input type="checkbox" name="farmaco" value="{{ $farmaco}}">
            </div>
            </li>
            @endforeach
            </ul>
        </div>
        @endisset
    </div>
</div>
<div class="flex flex-row justify-center mt-8 space-x-16">
    <input type="reset" value="Annulla Modifiche" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 w-[180px]">
    <input type="submit" value="Conferma Modifiche" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500 w-[180px]">
</div>
@endsection