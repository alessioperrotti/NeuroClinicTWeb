@extends('layouts.basic')

@section('title', 'Modifica Terapia')

@section('content')
@isset($paziente)
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Modifica terapia di {{$paziente->nome . " " . $paziente->cognome}}</h1>
@endisset
<form method="POST" action="{{ route(modificaTerapia.store, ['userPaz' => $paziente->username])}}">
<div class="flex justify-center">
    @csrf
    <div class="bg-white rounded-xl shadow-md h-auto min-w-[400px] mr-6 px-6 justify-center">
        <h3 class="my-4 font-bold text-xl text-center">Farmaci</h3>
        @isset($farmaci)
        <div class="flex-col mb-4">
            <ul style="list-style-type: disc" class="ml-6">
            @foreach($farmaci as $farmaco)
            <li class="mb-2">
            <div class="space-x-4">
                <label class="text-base text-gray-800">{{ $farmaco->nome}}</label>
                <input id={{'f'.$farmaco->id}} type="checkbox" name="farmaco" value="{{ $farmaco->nome}}">
            </div>
            <!-- div che deve comparire con JavaScript -->
            <div id="{{'divf'.$farmaco->id}}" class="flex-row space-x-1 hidden my-2">
                <select name="nvolteF" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                    <option value="1 volta">1 volta</option>
                    <option value="2 volte">2 volte</option>
                    <option value="3 volte">3 volte</option>
                    <option value="4 volte">4 volte</option>
                    <option value="5 volte">5 volte</option>
                    <option value="6 volte">6 volte</option>
                </select>
                <select name="periodoF" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                    <option value="al giorno">al giorno</option>
                    <option value="a settimana">a settimana</option>
                </select>
            </div>
            </li>
            @endforeach
            </ul>
        </div>
        @endisset
    </div>
    <div class="bg-white rounded-xl shadow-md h-auto min-w-[400px] ml-6 px-6 justify-center">
        <h3 class="my-4 font-bold text-xl text-center">Attività Riabilitative</h3>
        @isset($attivita)
        <div class="flex-col mb-4">
            <ul style="list-style-type: disc" class="ml-6">
            @foreach($attivita as $att)
            <li class="mb-2">
                <div class="space-x-4">
                <label class="text-base text-gray-800">{{ $att->nome}}</label>
                <input id={{'a'.$att->id}} type="checkbox" name="attivita" value="{{ $att->nome}}">
            </div>
            <div id="{{'diva'.$att->id}}" class="flex-row space-x-1 hidden my-2">
                <select name="nvolteA" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                    <option value="1 volta">1 volta</option>
                    <option value="2 volte">2 volte</option>
                    <option value="3 volte">3 volte</option>
                    <option value="4 volte">4 volte</option>
                    <option value="5 volte">5 volte</option>
                    <option value="6 volte">6 volte</option>
                </select>
                <select name="periodoA" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                    <option value="al giorno">al giorno</option>
                    <option value="a settimana">a settimana</option>
                </select>
            </div>
            </li>
            @endforeach
            </ul>
        </div>
        @endisset
    </div>
</div>
<div class="flex flex-row justify-center mt-8 space-x-16">
    <input type="reset" value="Annulla Modifiche" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 w-[180px]">
    <input type="submit" value="Conferma Modifiche" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500 w-[180px]">
</div>
</form>
<script>
    $(document).ready(function() {
        // Array di farmaci selezionati passato dal controller
        var farmTer = @json($farmTer);
        
        // Seleziona i checkbox corrispondenti
        farmTer.forEach(function(farmaco) {
            $('input[type="checkbox"][value="' + farmaco.nome + '"]').prop('checked', true);
            $('#' + 'divf' + farmaco.id).removeClass('hidden');
        });

        var attTer = @json($attTer);

        attTer.forEach(function(attivita) {
            $('input[type="checkbox"][value="' + attivita.nome + '"]').prop('checked', true);
            $('#' + 'diva' + attivita.id).removeClass('hidden');
        })

        // handler per il change della checkbox
        $('input[type="checkbox"][name="farmaco"]').change(function() {
            var checkbox = $(this);
            var divId = 'div' + checkbox.prop('id');  /* creo una connessione semantica tra il div e la
                                                checkbox posta sopra di esso (questo per ogni coppia input/div) */
            if (checkbox.is(':checked')) {
                $('#' + divId).removeClass('hidden');
            } else {
                $('#' + divId).addClass('hidden');
            }
        });

        
        $('input[type="checkbox"][name="attivita"]').change(function() {
            var checkbox = $(this);
            var divId = 'div' + checkbox.prop('id');  
            if (checkbox.is(':checked')) {
                $('#' + divId).removeClass('hidden');
            } else {
                $('#' + divId).addClass('hidden');
            }
        });

        
    });
</script>

@endsection