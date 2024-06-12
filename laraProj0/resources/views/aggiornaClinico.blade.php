@extends('layouts.basic')

@section('title', 'Modifica clinico')

@section('scripts')
@parent
<script src="{{ asset('js/functions.js') }}" ></script> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

    $(function() {

        var actionUrl = "{{ route('aggiornaClinico.edit') }}";
        var formId = 'aggiornaclinico'; //a questa assegnamo l'id della form
        $("#" + formId + " :input").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            var inputName = $(this).attr('name');
            doElemValidation(formElementId, actionUrl, formId, inputName); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#" + formId).on('submit', function(event) { //sarebbe l id della form. 
            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });

</script>
@endsection

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Modifica clinico {{$clinico->nome . " " . $clinico->cognome}}</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
        <form action="{{ route('aggiornaClinico.edit', $clinico->username) }}" method="POST" id="aggiornaclinico">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input id="nome" name="nome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->nome}}>
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input id="cognome" name="cognome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->cognome}}>
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input id="dataNasc" name="dataNasc" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value={{$clinico->dataNasc}}>
                </div>
                <div>
                    <label class="block text-gray-700">Ruolo</label>
                    <select id="ruolo" name="ruolo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="Medico" @if($clinico->ruolo == 'Medico') selected @endif>Medico</option>
                        <option value="Fisioterapista" @if($clinico->ruolo == 'Fisioterapista') selected @endif>Fisioterapista</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Specializzazione</label>
                    <input id="specializ" name="specializ" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{$clinico->specializ}}">
                </div>
            </div>
            <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                <a href="{{ route('homeClinico') }}">
                    <button type="button" class="bg-gray-500 hover:bg-gray-400 text-white py-2 px-4 rounded-md">Annulla Modifica</button>
                </a>
                <button type="submit" class="bg-cyan-600 hover:bg-cyan-500 text-white py-2 px-4 rounded-md">Conferma Modifica</button>
            </div>
        </form>
    </div>
</div>

@endsection