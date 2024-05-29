@extends('layouts.basic')

@section('title', 'Modifica Diagnosi')

@section('content')
@isset($paziente)
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Modifica diagnosi di {{ $paziente->nome . " " . $paziente->cognome }}</h1>
@endisset
<div class="flex flex-col items-center mb-8">
    <div class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8">
        <h3 class="text-2xl font-semibold">Disturbi diagnosticati</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6 mt-6 flex flex-wrap">
            @isset($disturbi)
                @foreach($disturbi as $disturbo)
                <li class="mb-4 w-1/2">
                    <div class="space-x-4">
                        <label class="text-base font-semibold text-gray-800">{{ $disturbo->nome}}</label>
                        <input id={{$disturbo->id}} type="checkbox" name="disturbo[]" value="{{ $disturbo->id}}">
                    </div>
                    <p class="my-2 text-gray-600 text-sm">Categoria: {{$disturbo->categoria}}</p>
                </li>
                @endforeach
            @endisset
        </ul>
    </div>

</div>
@endsection