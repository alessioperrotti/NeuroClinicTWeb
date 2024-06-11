@extends('layouts.basic')

@section('title', 'Gestione farmaci e attività')

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione farmaci</h1>
</div>
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <div class="mb-4">


        <input type="text" id="cercaFarmaco" placeholder="Cerca farmaco" class="bg-cyan-50 my-6 appearance-none w-full py-2 px-3
            border-0 border-b-2 border-gray-300 focus:border-black text-gray-700 leading-tight focus:outline-none">

        <div class="max-h-96 overflow-y-auto">



            @isset($farmaci)
            @foreach($farmaci as $farmaco)
            <div class="farmaco flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                <span class="nomeFarmaco font-bold">{{$farmaco->nome}}</span>
                <div class="flex mr-2 gap-x-4">
                    <button class="btnModificaFarmaco" data-id="{{$farmaco->id}}" data-nome="{{$farmaco->nome}}" data-descr="{{$farmaco->descr}}">
                        <img src="{{ asset('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                    </button>


                    <form action="{{route('gestioneFarmaci.delete')}}" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questo farmaco?')">
                        @csrf

                        <input type="hidden" name="idDel" value="{{$farmaco->id}}">
                        <button type="submit" class="btnEliminaFarmaco">

                            <img src="{{ asset('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                        </button>
                    </form>


                </div>
            </div>
            @endforeach
            @endisset

        </div>

    </div>

    <!-- Contenitore per il form di modifica del Farmaco, inizialmente nascosto -->
    <div id="formModificaFarmaco" class="mt-4 " style="display: none;">
        <hr class=" h-0.5 my-8 bg-cyan-600 border-0 ">

        <h1 class="text-lg font-bold ml-5 mt-5 mb-8 ">Modifica farmaco selezionato</h1>
        <form id="modificaFarmacoForm" action="{{route('gestioneFarmaci.update')}}" method="post">
            @csrf
            <div class="bg-white p-4 rounded-lg mt-3">

                <div class=" mb-6 mx-3 ">


                    <label for="nomeFarmacoMod" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="hidden" id="idFarmacoMod" name="id">


                    <input type="text" id="nomeFarmacoMod" name="nome" placeholder="Nome" class="shadow mb-2 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <label for="descrFarmacoMod" class="block mt-3 text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="descrFarmacoMod" name="descr" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnullaModFarmaco" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla Modifiche</button>
                    <button type="submit" id="btnConfermaModFarmaco" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma Modifiche</button>
                </div>
            </div>
        </form>
    </div>


    <div class="flex justify-center mt-10 mb-4">
        <!-- Bottone per aggiungere un nuovo Farmaco -->
        <button id="btnAggiungiFarmaco" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg ">Aggiungi Farmaco</button>
    </div>

    <!-- Contenitore per il form di inserimento nuovo Farmaco, inizialmente nascosto -->
    <div id="formNuovoFarmaco" class="mt-4 " style="display: none;">
        <hr class=" h-0.5 my-8 bg-cyan-600 border-0 ">
        <h1 class='text-lg font-bold ml-5 mt-5 mb-8 '>Aggiungi Farmaco</h1>
        <form id="nuovoFarmacoForm" action="{{route('gestioneFarmaci.store')}}" method="post">
            @csrf

            <div class="bg-white p-4 rounded-lg mt-3">
                <div class=" mb-6 mx-3 ">

                    <label for="nomeFarmaco" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="text" id="nomeFarmaco" name="nome" placeholder="Nome" class="shadow  appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <h1 class="text-sm mb-7 text-gray-600"> Il nome del farmaco deve essere seguito dalla grammatura</h1>
                    <label for="descrFarmaco" class="block text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="descrFarmaco" name="descr" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnullaFarmaco" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                    <button type="submit" id="btnConfermaInserimentoFarmaco" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
                </div>
            </div>
        </form>
    </div>




</div>

<div class="flex justify-center ">
    <hr class=" h-0.5 my-12 bg-cyan-600 border-0 w-full max-w-6xl ">
</div>
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione attività riabilitative</h1>
</div>
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <div class="mb-4">


        <input type="text" id="cercaAttivita" placeholder="Cerca attivita" class="bg-cyan-50 my-6 appearance-none w-full py-2 px-3
            border-0 border-b-2 border-gray-300 focus:border-black text-gray-700 leading-tight focus:outline-none">

        <div class="max-h-96 overflow-y-auto">



            @isset($attivita)
            @foreach($attivita as $attivitasing)
            <div class="attivita flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                <span class="nomeAttivita font-bold">{{$attivitasing->nome}}</span>
                <div class="flex mr-2 gap-x-4">
                    <button class="btnModificaAttivita" data-id="{{$attivitasing->id}}" data-nome="{{$attivitasing->nome}}" data-descr="{{$attivitasing->descr}}">
                        <img src="{{ asset('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                    </button>


                    <form action="{{route('gestioneAttivita.delete')}}" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questa attivita\'?')">
                        @csrf

                        <input type="hidden" name="idDel" value="{{$attivitasing->id}}">
                        <button type="submit" class="btnEliminaAttivita">

                            <img src="{{ asset('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                        </button>
                    </form>


                </div>
            </div>
            @endforeach
            @endisset

        </div>



    </div>


    <div class="flex justify-center  mt-10">
        <!-- Bottone per aggiungere un nuova attivita -->
        <button id="btnAggiungiAttivita" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">Aggiungi Attivita</button>
    </div>


    <!-- Contenitore per il form di modifica dell'Attivita, inizialmente nascosto -->
    <div id="formModificaAttivita" class="mt-4 " style="display: none;">
        <hr class=" h-0.5 my-8 bg-cyan-600 border-0 ">

        <h1 class="text-lg font-bold ml-5 mt-5 mb-8 ">Modifica attivita selezionata</h1>
        <form id="modificaAttivitaForm" action="{{route('gestioneAttivita.update')}}" method="post">
            @csrf
            <div class="bg-white p-4 rounded-lg mt-3">

                <div class=" mb-6 mx-3 ">

                    <input type="hidden" id="idAttivitaMod" name="id">

                    <label for="nomeAttivitaMod" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="text" id="nomeAttivitaMod" name="nome" placeholder="Nome" class="shadow mb-2 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                    <label for="descrAttivitaMod" class="block mt-3 text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="descrAttivitaMod" name="descr" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnullaModAttivita" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla Modifiche</button>
                    <button type="submit" id="btnConfermaModAttivita" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma Modifiche</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Contenitore per il form di inserimento nuovo Attivita, inizialmente nascosto -->
    <div id="formNuovaAttivita" class="mt-4 " style="display: none;">
        <hr class=" h-0.5 my-8 bg-cyan-600 border-0 ">
        <h1 class="text-lg font-bold ml-5 mt-5 mb-8 ">Aggiungi attivita</h1>
        <div class="bg-white p-4 rounded-lg mt-3">
            <form id="nuovaAttivitaForm"action="{{route('gestioneAttivita.store')}}" method="post">
                @csrf
                <div class=" mb-6 mx-3 ">

                    <label for="nomeAttivita" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="text" id="nomeAttivita" placeholder="Nome" name="nome" class="shadow mb-1 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                    <label for="descrAttivita" class="block mt-2 text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="descrAttivita" placeholder="Descrizione" name="descr" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnullaAttivita" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                    <button type="submit" id="btnConfermaInserimentoAttivita" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {

        //script per farmaci


        function resetForm(formId, fields) {
            $(formId).hide();
            fields.forEach(field => $(field).val(''));
        }

        function toggleForms(showFormId, hideFormId) {
            $(showFormId).show();
            $(hideFormId).hide();
        }

        $('#btnAggiungiFarmaco').on('click', function() {
            toggleForms('#formNuovoFarmaco', '#btnAggiungiFarmaco');
        });

        $('#btnAnnullaFarmaco').on('click', function() {
            resetForm('#formNuovoFarmaco', ['#nomeFarmaco', '#descrFarmaco']);
            $('#btnAggiungiFarmaco').show();
        });

        $(document).on('click', '.btnModificaFarmaco', function() {
            const id = $(this).data('id');
            const nome = $(this).data('nome');
            const categoria = $(this).data('descr');

            $('#nomeFarmacoMod').val(nome);
            $('#descrFarmacoMod').val(categoria);
            $('#idFarmacoMod').val(id);

            toggleForms('#formModificaFarmaco', '#formNuovoFarmaco');
            resetForm('#formNuovoFarmaco', ['#nomeFarmaco', '#descrFarmaco']);
            $("#btnAggiungiFarmaco").hide();
        });

        $("#btnAnnullaModFarmaco").on("click", function() {
            resetForm('#formModificaFarmaco', ['#nomeFarmaco', '#descrFarmaco']);
            $('#btnAggiungiFarmaco').show();
        });




        //script per attivita

        $('#btnAggiungiAttivita').on('click', function() {
            toggleForms('#formNuovaAttivita', '#btnAggiungiAttivita');
        });

        $('#btnAnnullaAttivita').on('click', function() {
            resetForm('#formNuovaAttivita', ['#nomeAttivita', '#descrAttivita']);
            $('#btnAggiungiAttivita').show();
        });

        $(document).on('click', '.btnModificaAttivita', function() {
            const id = $(this).data('id');
            const nome = $(this).data('nome');
            const descrizione = $(this).data('descr');

            $('#nomeAttivitaMod').val(nome);
            $('#descrAttivitaMod').val(descrizione);
            $('#idAttivitaMod').val(id);





            toggleForms('#formModificaAttivita', '#formNuovaAttivita');
            resetForm('#formNuovaAttivita', ['#nomeAttivita', '#descrAttivita']);
            $("#btnAggiungiAttivita").hide();
        });

        $("#btnAnnullaModAttivita").on("click", function() {
            resetForm('#formModificaAttivita', ['#nomeAttivita', '#descrAttivita']);
            $('#btnAggiungiAttivita').show();
        });


        //funzione per vedere gli id degli elementi (seleziona tutti gli elementi con id)
        $('[id]').each(function() {
            var id = this.id;
            var tagName = this.tagName;
            var form = $(this).closest('form');
            var isInForm = form.length > 0;
            var formId = isInForm ? form[0].id : 'N/A';
            var indent = isInForm ? '    ' : '';
            console.log(indent + tagName + ', ID: ' + id);

        });

        function cercaElemento(inputId, elementClass, textClass) {
            $(inputId).on('input', function() {
                var ricerca = $(inputId).val().toLowerCase();
                $(elementClass).each(function() {
                    var nome = $(this).find(textClass).text().toLowerCase();
                    if (nome.indexOf(ricerca) != -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        }


        cercaElemento("#cercaFarmaco", ".farmaco", ".nomeFarmaco");
        cercaElemento("#cercaAttivita", ".attivita", ".nomeAttivita");




    });




    //per la validazione della modifica del Farmaco con ajax
    $(function() {
        var actionUrl = "{{ route('gestioneFarmaci.update') }}";
        var formId = 'modificaFarmacoForm'; //a questa assegnamo l'id della form
        $("#" + formId + " :input ").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            console.log(formElementId);
            var inputName = $(this).attr('name'); //estraggo il nome dell'input
            doElemValidation(formElementId, actionUrl, formId, inputName); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#" + formId).on('submit', function(event) { //sarebbe l id della form. 

            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });

    //per la validazione dell'inserimento del Farmaco con ajax
    $(function() {
        var actionUrl = "{{ route('gestioneFarmaci.store') }}";
        var formId = 'nuovoFarmacoForm'; //a questa assegnamo l'id della form
        $("#" + formId + " :input ").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            console.log(formElementId);
            var inputName = $(this).attr('name'); //estraggo il nome dell'input

            doElemValidation(formElementId, actionUrl, formId, inputName ); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#" + formId).on('submit', function(event) { //sarebbe l id della form. 
            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });


    //per la validazione della modifica della Attivita con ajax
    $(function() {
        var actionUrl = "{{ route('gestioneAttivita.update') }}";
        var formId = 'modificaAttivitaForm'; //a questa assegnamo l'id della form
        $("#" + formId + " :input ").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            console.log(formElementId);
            var inputName = $(this).attr('name'); //estraggo il nome dell'input
            doElemValidation(formElementId, actionUrl, formId, inputName); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#" + formId).on('submit', function(event) { //sarebbe l id della form. 
            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });


    //per la validazione del inserimento di una Attivita con ajax
    $(function() {
        var actionUrl = "{{ route('gestioneAttivita.store') }}";
        var formId = 'nuovaAttivitaForm'; //a questa assegnamo l'id della form
        $("#" + formId + " :input ").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            console.log(formElementId);
            var inputName = $(this).attr('name'); //estraggo il nome dell'input
            doElemValidation(formElementId, actionUrl, formId, inputName); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#" + formId).on('submit', function(event) { //sarebbe l id della form. 
            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });
</script>


@endsection