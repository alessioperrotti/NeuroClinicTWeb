@extends('layouts.basic')

@section('title', 'Lista Pazienti')

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 my-8 gap-y-5">Cartelle cliniche</h1>
</div>
<div class=" text-lg container mx-auto mb-10 p-4 w-full max-w-4xl">
    <input type="text" name="cognomePaziente" placeholder="Cerca per cognome" 
    class=" bg-cyan-50 mb-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black
     text-gray-700 leading-tight  focus:outline-none" >
    <!-- gestire con javascript/jquery il meccanismo di ricerca -->

    @isset($pazienti)
    @foreach ($pazienti as $paziente)
        
        <div class="flex justify-between items-center bg-white pl-6 pr-4 py-4 rounded-lg mb-2">
            <span class="font-bold">{{ $paziente->nome . " " . $paziente->cognome }}</span>
            <div class="flex mr-2 gap-x-4">
                <a href="{{ route('cartellaClin2', [$paziente->username])}}">
                    <img src="{{ asset('images/cartella_clinica.png') }}" alt="Modifica" class="h-10 inline-block">
                </a>
            </div>
        </div>

    @endforeach
    @endisset()
    
</div>

@endsection