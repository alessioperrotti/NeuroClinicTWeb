@extends('layouts.basic')

@section('title', 'Gestione disturbi')

@section('content')
    <div class="flex justify-center">
        <h1 class="text-5xl font-bold ml-5 mt-5 mb-8 gap-y-5">Gestione disturbi motori</h1>
    </div>
    <div id="app" class="text-lg container mx-auto p-4 w-full max-w-4xl">
        <form id="listaDisturbi" class="mb-4">
            @csrf
            @isset($disturbi)
            @foreach($disturbi as $disturbo)
            <div class="disturbo flex justify-between items-center bg-white p-2 rounded-lg mb-2">
                <span class="nomeDisturbo font-bold">{{$disturbo->nome}}</span>
                <div class="flex mr-2 gap-x-4">
                    <button type="button" class="btnModifica" data-nome="{{ $disturbo->nome }}" data-categoria="{{$disturbo->categoria}}">
                        <img src="{{ url('images/btnModifica.jpeg') }}" alt="Modifica" class="w-6 h-6 inline-block">
                    </button>
                    <form action="{{ route('gestioneDisturbi.delete', $disturbo->nome) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="btnElimina">
                            <img src="{{ url('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            @endisset
        </form>
        <div class="flex justify-center mt-10">
            <button id="btnAggiungiDisturbo" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4">Aggiungi Disturbo</button>
        </div>
        <div id="formNuovoDisturbo" class="mt-4" style="display: {{ $errors->any() ? 'block' : 'none' }};">
            <form action="{{ route('gestioneDisturbi.store') }}" method="post">
                @csrf
                <hr class="h-0.5 my-8 bg-cyan-600 border-0">
                <div class="bg-white p-4 rounded">
                    <div class="mb-6 flex justify-between">
                        <div>
                            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                            <input name="nome" type="text" id="nome" placeholder="Nome" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @if ($errors->first('nome'))
                            <ul class="errors">
                                @foreach ($errors->get('nome') as $message)
                                <li class="text-red">{{ $message }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div>
                            <label for="categoria" class="block text-gray-700 text-sm font-bold mb-2">Categoria</label>
                            <input name="categoria" type="text" id="categoria" placeholder="Categoria" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @if ($errors->first('categoria'))
                            <ul class="errors">
                                @foreach ($errors->get('categoria') as $message)
                                <li class="text-red">{{ $message }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-center gap-x-14">
                        <button type="reset" id="btnAnnulla" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla</button>
                        <button type="submit" id="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Conferma inserimento</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="formModificaDisturbo" class="mt-4" style="display: none;">
            <hr class="h-0.5 my-8 bg-cyan-600 border-0">
            <h1>Modifica disturbo selezionato</h1>
            <div class="bg-white p-4 rounded">
                <div class="mb-6 flex justify-between">
                    <div>
                        <label for="nomeMod" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                        <input type="text" id="nomeMod" placeholder="Nome" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="categoriaMod" class="block text-gray-700 text-sm font-bold mb-2">Categoria</label>
                        <input type="text" id="categoriaMod" placeholder="Categoria" class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div class="flex justify-center gap-x-14">
                    <button type="reset" id="btnAnnullaMod" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Annulla Modifica</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifica Disturbo</button>
                </div>
            </div>
        </div>
        <!-- Il codice JavaScript deve essere incluso alla fine del body -->
        <script>
            $(document).ready(function() {
                $('#btnAggiungiDisturbo').on('click', function() {
                    console.log("Aggiungi Disturbo button clicked");
                    $('#formNuovoDisturbo').show();
                });

                $('#btnAnnulla').on('click', function() {
                    console.log("Annulla button clicked");
                    $('#formNuovoDisturbo').hide();
                    $('#nome').val('');
                    $('#categoria').val('');
                });

                $(document).on('click', '.btnModifica', function() {
                    console.log("Modifica button clicked");
                    const nome = $(this).data('nome');
                    const categoria = $(this).data('categoria');
                    console.log("Modifica Disturbo:", nome, categoria);

                    $('#formModificaDisturbo').show();
                    $('#nomeMod').val(nome);
                    $('#categoriaMod').val(categoria);
                });

                $('#btnAnnullaMod').on('click', function() {
                    console.log("Annulla Modifica button clicked");
                    $('#formModificaDisturbo').hide();
                    $('#nomeMod').val('');
                    $('#categoriaMod').val('');
                });
            });
        </script>
    </div>
@endsection