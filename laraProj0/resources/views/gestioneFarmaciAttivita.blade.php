@extends('layouts.basic')

@section('title', 'Gestione farmaci e attività')

@section('content')
<div class="flex justify-center">
    <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione farmaci</h1>
</div>
<div id="app" class=" text-lg container mx-auto p-4 w-full max-w-4xl">
    <form id="listaFarmaci" class="mb-4">

        <div class="flex justify-between items-center bg-white p-2 rounded-lg mb-2">
            <span class=" font-bold">Rivotril 2mg</span>
            <div class="flex mr-2 gap-x-4">
                <button id="btnModifica">
                    <img src="{{ url('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                </button>
                <button id="btnElimina">
                    <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">    
                </button>
            </div>
        </div>
        <!-- da aggiungere farmaci -->
    </form>

    <div class="flex justify-center  mt-10">
    <!-- Bottone per aggiungere un nuovo Farmaco -->
    <button id="btnAggiungiFarmaco" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4 ">Aggiungi Farmaco</button>
    </div>

    <!-- Contenitore per il form di inserimento nuovo Farmaco, inizialmente nascosto -->
    <div id="formNuovoFarmaco" class="mt-4 " style="display: none;">
        <hr class=" h-0.5 my-8 bg-cyan-600 border-0 ">
        <div class="bg-white p-4 rounded-lg">
            <div class=" mb-6 mx-3 " >
                
                    <label for="nomeFarmaco" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="text" id="nomeFarmaco" placeholder="Nome" class="shadow mb-7 appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                
                    <label for="DescrizioneFarmaco" class="block text-gray-700 text-sm font-bold mb-2">Descrizione</label>
                    <textarea id="DescrizioneFarmaco" placeholder="Descrizione" class="shadow appearance-none border rounded h-28 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </textarea>
            </div>
            <div class="flex justify-center gap-x-14">
                <button id="btnAnnullaFarmaco" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                <button id="btnConfermaInserimentoFarmaco" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
            </div>
        </div>
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
                <div class=" mb-6 mx-3 " >
                    
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


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        //AGGIUNTA FARMACI
        document.getElementById('btnAggiungiFarmaco').addEventListener('click', function() {
            // Mostra la form di inserimento nuovo Farmaco
            document.getElementById('formNuovoFarmaco').style.display = 'block';
        });

        document.getElementById('btnAnnullaFarmaco').addEventListener('click', function() {
            // Nasconde la form e resetta i campi
            document.getElementById('formNuovoFarmaco').style.display = 'none';
            document.getElementById('nomeFarmaco').value = '';
            document.getElementById('DescrizioneFarmaco').value = '';
        });
        //AGGIUNTA ATTIVITA
        document.getElementById('btnAggiungiAttivita').addEventListener('click', function() {
            // Mostra la form di inserimento nuovo Attivita
            document.getElementById('formNuovaAttivita').style.display = 'block';
        });

        document.getElementById('btnAnnullaAttivita').addEventListener('click', function() {
            // Nasconde la form e resetta i campi
            document.getElementById('formNuovaAttivita').style.display = 'none';
            document.getElementById('nomeAttivita').value = '';
            document.getElementById('DescrizioneAttivita').value = '';
        });

        // Da aggiungere gestore di eventi per Modifica ed Elimina
    });
</script>
@endsection