@extends('layouts.basic')

@section('title', 'Elimina Paziente')

@section('content')

<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Elimina Paziente</h1>
</div>
<div id="app" class="text-lg container mx-auto p-4 w-full max-w-4xl">
    
    <input type="text" id="cognomeClinico" placeholder="Cerca per cognome" class="bg-cyan-50 my-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black text-gray-700 leading-tight focus:outline-none">

    <div id="listaPazienti" class="mb-4">
        @isset($pazienti)
            @foreach ($pazienti as $paziente)
                <div class="flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                    <span class="font-bold">{{$paziente->nome . " " . $paziente->cognome}}</span>
                    <div class="flex mr-2 gap-x-4">
                        <form action="{{ route('eliminaPaziente', $paziente->username) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                if (!confirm('Sei sicuro di voler eliminare questo paziente?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>

@endsection
