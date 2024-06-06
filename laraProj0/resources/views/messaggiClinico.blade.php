@extends('layouts.basic')

@section('title', 'Messaggi Clinico')


@section('scripts')

@parent
<script>

</script>
@endsection

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Messaggi con i pazienti</h1>
<div class="bg-white rounded-xl shadow-md mx-10 p-8">
    <div class="flex flex-row justify-left space-x-4">  <!-- con js aggiungere basis 3/5 -->
        <a class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Ricevuti</a>
        <a class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Inviati</a>
        <a class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl text-cyan-600 font-semibold">Nuovo Messaggio</a>
    </div>
    <hr class="h-0.5 my-1 bg-cyan-600">
    <div id="ricevuti" class="messaggi border rounded-md">
        @isset($messaggiRic)
            @foreach($messaggiRic as $msgR)
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-2xl">Da {{ $msgR->mittente->nome . " " . $msgR->mittente->cognome}}</h3>
                    <p class="text-gray-500">{{ $msgR->created_at}}</p>
                </div>
                <p class="text-gray-600">{{ $msgR->testo}}</p>
            @endforeach
        @endisset
    </div>
    <div id="inviati" class="messaggi hidden border rounded-md">
        @isset($messaggiInv)
            @foreach($messaggiInv as $msgI)
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-2xl">Da {{ $msgI->mittente->nome . " " . $msgI->mittente->cognome}}</h3>
                    <p class="text-gray-500">{{ $msgI->created_at}}</p>
                </div>
                <p class="text-gray-600">{{ $msgI->testo}}</p>
            @endforeach
        @endisset
    </div>
    <div class="inline hidden"> <!-- con js aggiungere basis 2/5 -->
        <form class="flex flex-col justify-center">
            @csrf

        </form>
    </div>

</div>

@endsection