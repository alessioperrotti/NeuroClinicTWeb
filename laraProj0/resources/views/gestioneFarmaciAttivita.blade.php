@extends('layouts.basic')

@section('title', 'Gestione farmaci e attività')

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione farmaci</h1>
</div>
<div id="app" class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <div class="mb-4">


        <input type="text" id="cercaDisturbo" placeholder="Cerca disturbo" class="bg-cyan-50 my-6 appearance-none w-full py-2 px-3
            border-0 border-b-2 border-gray-300 focus:border-black text-gray-700 leading-tight focus:outline-none">

        <div class="max-h-96 overflow-y-auto">



            @isset($farmaci)
            @foreach($farmaci as $farmaco)
            <div class="flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                <span class=" font-bold">{{$farmaco->nome}}</span>
                <div class="flex mr-2 gap-x-4">
                    <button class="btnModificaFarmaco" data-id="{{$farmaco->id}}" data-nome="{{$farmaco->nome}}" data-descr="{{$farmaco->descr}}">
                        <img src="{{ url('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                    </button>


                    <form action="{{route('gestioneFarmaci.delete')}}" method="post"  onsubmit="return confirm('Sei sicuro di voler eliminare questo farmaco?')">
                        @csrf
                        
                        <input type="hidden" name="idDel" value="{{$farmaco->id}}">
                        <button type="submit" class="btnEliminaFarmaco">

                            <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
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

        <h1>Modifica farmaco selezionato</h1>
        <form action="{{route('gestioneFarmaci.update')}}" method="post">
            @csrf
            <div class="bg-white p-4 rounded-lg mt-3">

                <div class=" mb-6 mx-3 ">


                    <label for="nomeFarmacoMod" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="hidden" id="idMod" name="idMod">

                    <input type="text" id="nomeFarmacoMod" name="nomeMod" placeholder="Nome" class="shadow mb-7 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                    <label for="descrizioneFarmacoMod" class="block text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="descrizioneFarmacoMod" name="descrMod" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </textarea>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="reset" id="btnAnnullaModFarmaco" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla Modifiche</button>
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
        <h1>Aggiungi Farmaco</h1>
        <form action="{{route('gestioneFarmaci.store')}}" method="post">
            @csrf

            <div class="bg-white p-4 rounded-lg mt-3">
                <div class=" mb-6 mx-3 ">

                    <label for="nomeFarmaco" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="text" id="nomeFarmaco" name="nome" placeholder="Nome" class="shadow  appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <h1 class="text-sm mb-7 text-gray-600"> Il nome del farmaco deve essere seguito dalla grammatura</h1>
                    <label for="descrizioneFarmaco" class="block text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="descrizioneFarmaco" name="descr" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
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
<div id="app" class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <form id="listaAttivita" class="mb-4">

        <div class="flex justify-between items-center bg-white p-2 rounded-lg mb-2">
            <span class=" font-bold">Fisioterapia</span>
            <div class="flex mr-2 gap-x-4">
                <button id="btnModifica">
                    <img src="{{ url('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                </button>
                <button id="btnElimina">
                    <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                </button>
            </div>
        </div>
        <!-- da aggiungere attività -->
    </form>


    <div class="flex justify-center  mt-10">
        <!-- Bottone per aggiungere un nuova attivita -->
        <button id="btnAggiungiAttivita" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">Aggiungi Attivita</button>
    </div>

    <!-- Contenitore per il form di inserimento nuovo Attivita, inizialmente nascosto -->
    <div id="formNuovaAttivita" class="mt-4 " style="display: none;">
        <hr class=" h-0.5 my-8 bg-cyan-600 border-0 ">
        <div class="bg-white p-4 rounded-lg">
            <div class=" mb-6 mx-3 ">

                <label for="nomeAttivita" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                <input type="text" id="nomeAttivita" placeholder="Nome" class="shadow mb-7 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                <label for="DescrizioneAttivita" class="block text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                <textarea id="DescrizioneAttivita" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </textarea>
            </div>
            <div class="flex justify-center gap-x-14">
                <button id="btnAnnullaAttivita" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                <button id="btnConfermaInserimentoAttivita" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
            </div>
        </div>
    </div>
</div>
</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {
        //codice per l'aggiunta del farmaco
        $('#btnAggiungiFarmaco').on('click', function() {
            $('#formNuovoFarmaco').show();
            $(this).hide();
        });

        $('#btnAnnullaFarmaco').on('click', function() {
            $('#formNuovoFarmaco').hide();
            $('#nomeFarmaco').val('');
            $('#descrizioneFarmaco').val('');
            $('#btnAggiungiFarmaco').show();
        });


        //codice per la modifica del farmaco
        $(document).on('click', '.btnModificaFarmaco', function() {
            //estrae i valori del tasto btnModificaFarmaco
            const id = $(this).data('id');
            const nome = $(this).data('nome');
            const categoria = $(this).data('descr');

            //riempe i campi del form
            $('#nomeFarmacoMod').val(nome);
            $('#descrizioneFarmacoMod').val(categoria);
            $('#idMod').val(id);

            //mostra il form
            $('#formModificaFarmaco').show();


            $('#formNuovoFarmaco').hide();
            $('#nomeFarmaco').val('');
            $('#descrizioneFarmaco').val('');

            //nasconde il tasto per aggiungere
            $("#btnAggiungiFarmaco").hide();

        });

        $("#btnAnnullaModFarmaco").on("click", function() {
            //nasconde la modifica del farmaco
            $('#formModificaFarmaco').hide();
            $('#nomeFarmaco').val('');
            $('#descrizioneFarmaco').val('');
            $('#btnAggiungiFarmaco').show();
        })





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

    });


    //per la validazione della modifica con ajax
    $(function() {
        var actionUrl = "{{ route('gestioneDisturbi.update') }}";
        var formId = 'formModificaDisturbo'; //a questa assegnamo l'id della form
        $(":input").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, actionUrl, formId); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#btnEffettuaMod").on('submit', function(event) { //sarebbe l id della form. 
            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });

    //per la validazione dell'inserimento con ajax
    $(function() {
        var actionUrl = "{{ route('gestioneDisturbi.store') }}";
        var formId = 'formNuovoDisturbo'; //a questa assegnamo l'id della form
        $(":input").on('blur', function(event) { //tutti gli elementi di tipo input, 
            //quando mi sposto su un altro elemento di input, estraggo l'id
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, actionUrl, formId); //questa funzione fa la validazione. funzione definita sul file function.js
        });
        $("#btnAggiungi").on('submit', function(event) { //sarebbe l id della form. 
            event.preventDefault(); //blocca il meccanismo standard, deve inviarae solo dopo la validazione
            doFormValidation(actionUrl, formId); //valida l'intera form
        });
    });
</script>


@endsection