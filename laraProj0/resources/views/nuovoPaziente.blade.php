@extends('layouts.basic')

@section('title', 'Inserimento Nuovo Paziente')

@section('scripts')
@parent
<script src="{{ asset('js/functions.js') }}" ></script> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$(function () {
    var actionUrl = "{{ route('nuovoPaziente.store')}}";  // chiamata per la submit ma anche per la validazione
    var formId = 'addpaziente';
$(":input").on('blur', function (event) {  /* prendiamo tutti gli elementi di input e assegnamo 
    un handler all'evento di blur (perdita del focus) */
        var formElementId = $(this).attr('id');
        doElemValidation(formElementId, actionUrl, formId);  // la funzione è definita in functions.js
    });
    $("#addpaziente").on('submit', function (event) {  // assegnamo un handler per il submit
        event.preventDefault();  // disabilitiamo il processo standard di submit
        doFormValidation(actionUrl, formId);  // altra funzione di functions.js
    });
});
</script>

@endsection

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5">Inserimento nuovo paziente</h1>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl mb-12">
        <form method="POST" action="{{ route('nuovoPaziente.store')}}" id="addpaziente">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input name="nome" type="text" maxlength="30" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Nome">
                </div>
                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input name="cognome" type="text" maxlength="30" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Cognome">
                </div>
                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input name="dataNasc" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Data di nascita">
                </div>
                <div>
                    <label class="block text-gray-700">Genere</label>
                    <select name="genere" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="M" class="text-gray-700">Uomo</option>
                        <option value="F" class="text-gray-700">Donna</option>
                        <option value="A" class="text-gray-700">Altro</option>
                    </select>
                </div>
                <div class="flex">
                    <div class="basis-2/3">
                        <label class="block text-gray-700">Via</label>
                        <input name="via" type="text" maxlength="30" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Via">
                    </div>
                    <div class="basis-1/3 pl-2">
                        <label class="block text-gray-700">Civico</label>
                        <input name="civico" type="text" maxlength="5" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Civico">
                    </div>
                </div>
                <div class="flex">
                    <div class="basis-2/3">
                        <label class="block text-gray-700">Città</label>
                        <input name="citta" type="text" maxlength="30" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Città">
                    </div>
                    <div class="basis-1/3 pl-2">
                        <label class="block text-gray-700">Provincia</label>
                        <select name="prov" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            @isset($province)
                            @foreach($province as $provincia)
                                <option value={{$provincia}} class="text-gray-700">{{$provincia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700">Telefono</label>
                    <input name="telefono" type="tel" maxlength="30" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Telefono">
                </div>
                <div>
                    <label class="block text-gray-700">E-Mail</label>
                    <input name="email" type="email" maxlength="40" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Email">
                </div>
                <div>
                    <label class="block text-gray-700">Username</label>
                    <input name="username" type="text" maxlength="20" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Username">
                </div>
                <div>
                    <label class="block text-gray-700">Clinico Associato</label>
                    <select name="clinico" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @isset($clinici)
                        @foreach($clinici as $clinico)
                        <option value={{$clinico->username}}>{{$clinico->nome . " " . $clinico->cognome}}</option>
                        @endforeach
                    @endisset
                    </select>
                </div>
            </div>
            <div class="flex justify-center mt-4 gap-y-4 gap-x-24">
                <input type="reset" value="Annulla Inserimento" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400">
                <input type="submit" value="Conferma Inserimento" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500">
            </div>
        </form>
    </div>
</div>
@endsection