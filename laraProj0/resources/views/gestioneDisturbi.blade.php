@extends('layouts.basic')

@section('title', 'Gestione disturbi')

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione disturbi motori</h1>
</div>

<div id="app" class="text-lg container mx-auto p-4 w-full max-w-4xl">

    <input type="text" id="cercaDisturbo" placeholder="Cerca disturbo" class="bg-cyan-50 my-6 appearance-none w-full py-2 px-3
    border-0 border-b-2 border-gray-300 focus:border-black text-gray-700 leading-tight focus:outline-none">


    <div class="max-h-96 overflow-y-auto">
        @isset($disturbi)
        @foreach($disturbi as $disturbo)
        <div class="disturbo flex justify-between items-center bg-white p-2 rounded-lg mb-2">
            <span class="nomeDisturbo font-bold">{{$disturbo->nome}}</span>
            <div class="flex mr-2 gap-x-4">
                <button type="button" class="btnModifica" data-id="{{$disturbo->id}}" data-nome="{{ $disturbo->nome }}" data-categoria="{{$disturbo->categoria}}">
                    <img src="{{ asset('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                </button>
                <form action="{{ route('gestioneDisturbi.delete') }}" method="POST" class="inline-block" onsubmit="return confirm('Sei sicuro di voler eliminare questo disturbo?')">
                    @csrf
                    <input type="hidden" name="idDel" value="{{$disturbo->id}}">
                    <button type="submit" id="btnElimina">
                        <img src="{{ asset('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        @endisset

    </div>


    <div class="flex justify-center mt-10">
        <button id="btnAggiungiDisturbo" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4">Aggiungi Disturbo</button>
    </div>
    <div id="formNuovoDisturbo" class="mt-4" style="display:none">
        <form id="nuovoDisturboForm" action="{{ route('gestioneDisturbi.store') }}" method="post">
            @csrf
            <hr class="h-0.5 my-8 bg-cyan-600 border-0">
            <h1 class="text-lg font-bold ml-5 mt-5 mb-8 ">Aggiungi Disturbo</h1>

            <div class="bg-white p-4 rounded">
                <div class="mb-6 flex justify-between">
                    <div>
                        <label for="nomeDisturboNuovo" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                        <input name="nome" type="text" id="nomeDisturboNuovo" placeholder="Nome" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                    </div>
                    <div>
                        <label for="categoriaDisturboNuovo" class="block text-gray-700 text-sm font-bold mb-2">Categoria</label>
                        <input name="categoria" type="text" id="categoriaDisturboNuovo" placeholder="Categoria" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                    </div>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnulla" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                    <button type="submit" id="btnAggiungi" class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
                </div>
            </div>
        </form>
    </div>

    <div id="formModificaDisturbo" class="mt-4" style="display: none;">
        <form id="modificaDisturboForm" action="{{route('gestioneDisturbi.update')}}" method="post">
            @csrf

            <hr class="h-0.5 my-8 bg-cyan-600 border-0">
            <h1 class='text-lg font-bold ml-5 mt-5 mb-8 '>Modifica disturbo selezionato</h1>
            <div class="bg-white p-4 rounded mb-10">
                <div class="mb-6 flex justify-between mx-14">
                    <input type="hidden" id="idMod" name="id" value="">
                    <div>
                        <label for="nomeMod" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                        <input type="text" id="nomeMod" name="nome" placeholder="Nome" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="categoriaMod" class="block text-gray-700 text-sm font-bold mb-2">Categoria</label>
                        <input type="text" id="categoriaMod" name="categoria" placeholder="Categoria" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="button" id="btnAnnullaMod" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla Modifica</button>
                    <button type="submit" id="btnEffettuaMod" class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded">Modifica Disturbo</button>
                </div>
            </div>
        </form>
    </div>

</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {


        function resetForm(formId, fields) {
            $(formId).hide();
            fields.forEach(field => $(field).val(''));
        }

        function toggleForms(showFormId, hideFormId) {
            $(showFormId).show();
            $(hideFormId).hide();
        }

        //codice per l'aggiunta del disturbo
        $('#btnAggiungiDisturbo').on('click', function() {
            toggleForms('#formNuovoDisturbo', '#btnAggiungiDisturbo');

        });

        $('#btnAnnulla').on('click', function() {

            resetForm('#formNuovoDisturbo', ['#nomeDisturboNuovo', '#categoriaDisturboNuovo']);
            $('#btnAggiungiDisturbo').show();
        });

        //codice per la modifica del disturbo
        $(document).on('click', '.btnModifica', function() {
            //estrae i valori del tasto btnModifica
            const id = $(this).data('id');
            const nome = $(this).data('nome');
            const categoria = $(this).data('categoria');

            //riempe i campi del form
            $('#nomeMod').val(nome);
            $('#categoriaMod').val(categoria);
            $('#idMod').val(id);

            //mostra il form

            toggleForms('#formModificaDisturbo', '#formNuovoDisturbo');
            resetForm('#formNuovoDisturbo', ['#nomeDisturboNuovo', '#categoriaDisturboNuovo']);
            $("#btnAggiungiDisturbo").hide();

        });

        $("#btnAnnullaMod").on("click", function() {
            resetForm('#formModificaDisturbo', ['#nomeMod', '#categoriaMod']);
            $('#btnAggiungiDisturbo').show();
        });



        // Funzione che implementa il cerca disturbo
        $("#cercaDisturbo").on('input', function() {
            var ricerca = $("#cercaDisturbo").val().toLowerCase(); // Prende la parola inserita nel campo di ricerca
            $(".disturbo").each(function() {
                var nome = $(this).find(".nomeDisturbo").text().toLowerCase(); // Trova il testo del nome del disturbo
                if (nome.indexOf(ricerca) != -1) {
                    $(this).show(); // Mostra l'elemento se corrisponde alla ricerca
                } else {
                    $(this).hide(); // Nasconde l'elemento se non corrisponde alla ricerca
                }
            });
        });



        //per la validazione della modifica con ajax
        $(function() {
            var actionUrl = "{{ route('gestioneDisturbi.update') }}";
            var formId = 'modificaDisturboForm'; //a questa assegnamo l'id della form
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

        //per la validazione dell'inserimento con ajax
        $(function() {
            var actionUrl = "{{ route('gestioneDisturbi.store') }}";
            var formId = 'nuovoDisturboForm'; //a questa assegnamo l'id della form
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
    });
</script>
@endsection