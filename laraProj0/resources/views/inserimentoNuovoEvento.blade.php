@extends('layouts.basic')

@section('title', 'Nuovo Evento')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-black font-bold text-5xl mx-8 mt-4">Inserimento nuovo evento di disturbo motorio</h1>
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12 mb-12">
        <form id="evento-form" method="POST" action="{{ route('inserimentoNuovoEvento.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700 font-semibold">Disturbo</label>
                    <select id="disturbo" name="disturbo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @isset($disturbi)
                        @if(!$disturbi->isEmpty())
                            @foreach($disturbi as $disturbo)
                                @if($disturbo)
                                <option value="{{ $disturbo->id }}">{{ $disturbo->nome }}</option> <!-- Adatta id e name ai tuoi attributi -->
                                @endif
                            @endforeach
                        @endif
                        @endisset
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Data</label>
                    <input id="data" name="data" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Ora</label>
                    <input id="ora" name="ora" type="time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Durata (secondi)</label>
                    <input id="durata" name="durata" type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Intensità</label>
                    <select id="intensita" name="intensita" size="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div>
                    <input id="paziente" name="paziente" hidden value={{$userPaz}}>
                </div>
            </div>
            <div class="flex justify-center mt-8 gap-y-4 gap-x-24">
                <input name="annulla" type="reset" value="Annulla Inserimento" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 cursor-pointer"></input>
                <input id="submit" name="conferma" type="submit" value="Conferma Inserimento" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500 cursor-pointer "></input>
            </div>
        </form>
    </div>
</div>
<hr class="h-0.5 my-2 bg-cyan-600 mx-4">
<h2 class="text-3xl font-bold ml-5 mt-5 mb-8">Episodi registrati</h2>
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl mt-6">

    @isset($episodi)
    @foreach ($episodi as $episodio)
        @if($episodio)
        <div class="flex justify-between items-center bg-white p-4 rounded-lg mb-2" data-disturbo="{{$episodio->disturbo->nome}}" data-intensita="{{$episodio->intensita}}">
            <div class="flex flex-row space-x-2">
                <p class="font-bold">{{ $episodio->disturbo->nome }}</p>
                <p class="text-gray-500 font-semibold">{{"(Intensità:" . $episodio->intensita . ")"}}</p>
            </div>
            <div class="flex items-center space-x-4">
                <p class="text-gray-500">del {{\Carbon\Carbon::parse($episodio->data)->format('d-m-Y')}} alle {{\Carbon\Carbon::parse($episodio->ora)->format('H:i')}}</p>
                <form action="{{route('episodio.elimina', $episodio->id)}}" method="POST" class="delete-form inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo disturbo?');">
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('images/btnElimina.png') }}" alt="Elimina" class="w-6 h-6 inline-block">
                    </button>
                </form>
            </div>
        </div>
        @endif
    @endforeach
    @endisset

    @if($episodi == null || $episodi->isEmpty())
        <p class="font-semibold text-center mb-10">Non ci sono episodi segnalati.</p>
    @endif

</div>

<script src="{{ asset('js/functions.js') }}"></script>

<script>
   
    $(document).ready(function() {
        elem_id = "back_button";
        rotta = "{{ route('homePaziente') }}";
        sovrascriviOnClick(elem_id, rotta);


        function setupValidation(actionUrl, formId) {
            // Aggiunge un listener per l'evento 'blur' a tutti gli input del form
            $("#" + formId + " :input").on('blur', function() {
                // Ottiene l'ID e il nome dell'input attualmente in focus
                var formElementId = $(this).attr('id');
                var inputName = $(this).attr('name');
                // Chiama la funzione di validazione per l'elemento corrente
                doElemValidation(formElementId, actionUrl, formId, inputName);
            });

            // Aggiunge un listener per l'evento 'submit' del form
            $("#" + formId).on('submit', function(event) {
                // Previene l'invio predefinito del form
                event.preventDefault();
                // Chiama la funzione di validazione per l'intero form
                doFormValidation(actionUrl, formId);
            });
        }

        var actionUrl = "{{ route('inserimentoNuovoEvento.store') }}";
        var formId = 'evento-form';
        setupValidation(actionUrl, formId);

    });
</script>
@endsection


