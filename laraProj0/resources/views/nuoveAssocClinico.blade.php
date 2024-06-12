@extends('layouts.basic')

@section('title', 'Nuove Associazioni Clinico')

@section('content')
<div class="flex items-center justify-center flex-col">
    <h1 class="text-5xl font-bold mt-5 mb-8">Nuove Associazioni Clinici</h1>
    <div class="bg-white rounded-lg shadow-md w-[600px] p-8 mb-12">
        <p class="text-xl text-gray-700">Prima di eliminare il clinico è necessario stabilire delle nuove associazioni per 
            i pazienti che erano in cura con lui. <br>Per ogni paziente, seleziona il clinico che si occuperà
            delle sue cure.
        </p>

        @isset($pazienti, $clinici, $userClin)
            <form id="formAssociazioni" action="{{ route('clinico.elimina', $userClin) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo clinico?');">
                @csrf
                @foreach($pazienti as $paziente)
                <div class="flex my-4 items-center justify-center space-x-8">
                    <label class="text-xl font-semibold">{{$paziente->nome . " " . $paziente->cognome}}</label>
                    <select name="{{$paziente->username}}" class="mt-1 blockp-2 border border-gray-300 rounded-md h-10 p-2">
                        @foreach($clinici as $clinico)
                            <option value="{{$clinico->username}}">{{$clinico->nome . " " . $clinico->cognome}}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach
                <div class="flex justify-center mt-8">
                    <input type="submit" value="Conferma" class="bg-cyan-600 hover:bg-cyan-500 text-white text-xl py-2 px-4 rounded-md">
                </div>
            </form>
        @endisset

    </div>
</div>

@endsection