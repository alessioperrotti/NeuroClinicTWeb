@extends('layouts.basic')

@section('title', 'Cartella Paziente')

@section('content')
@isset($paziente)
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Cartella clinica di {{ $paziente->nome . " " . $paziente->cognome }}</h1>
@endisset  <!-- spostare in basso -->
<div class="flex flex-col items-center">
    <div name="container_terapia" class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8 min-w-[800px]">
        <h3 class="text-2xl font-semibold">Anagrafica Paziente</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($paziente)
                <li class="mb-4">
                    <p class="font-semibold inline">Nome: </p>
                    <p class="inline">{{ $paziente->nome . " " . $paziente->cognome}}</p>
                </li>
                <li class="mb-4">
                    <p class="font-semibold inline">Data di nascita: </p>
                    <p class="inline">{{ \Carbon\Carbon::parse($paziente->dataNasc)->format('d-m-Y')}}</p>
                </li>
                <li class="mb-4">
                    <p class="font-semibold inline">Genere: </p>
                    <p class="inline">{{ $paziente->genere}}</p>
                </li>
                <li class="mb-4">
                    <p class="font-semibold inline">Indirizzo: </p>
                    <p class="inline">{{ $paziente->via . " " . $paziente->civico . ", " . $paziente->citta . " (" . $paziente->prov . ")"}}</p>
                </li>
                <li class="mb-4">
                    <p class="font-semibold inline">Telefono: </p>
                    <p class="inline">{{ $paziente->telefono}}</p>
                </li>
                <li class="mb-4">
                    <p class="font-semibold inline">Indirizzo E-mail: </p>
                    <p class="inline">{{ $paziente->email}}</p>
                </li>
            @endisset
        </ul>
        <h3 class="text-2xl mt-10 font-semibold">Disturbi diagnosticati</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">

            @if($disturbi == null)
                <li ><p class="font-semibold">Non ci sono disturbi diagnosticati.</p>
            @else
                @foreach($disturbi as $disturbo)
                    @if($disturbo)
                        <li class="mb-4">{{ $disturbo->nome}}
                    @endif
                @endforeach
            @endif
            
        </ul>
        <h3 class="text-2xl font-semibold mt-10">Terapia attiva</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <ul style="list-style-type: disc" class="ml-6">
            @isset($farmaci)
                @foreach($farmaci as $farmaco)   
                <li class="mb-4"><p class="font-semibold">{{ $farmaco['farmaco']->nome ." (". $farmaco['freq'] . ")"}}</p>
                    <p class="text-gray-500">{{ $farmaco['farmaco']->descr}}</p>
                @endforeach
            @endisset

            @if($farmaci == null)
                <li><p class="font-semibold">Non ci sono farmaci prescritti.</p>
            @endif
            
            @isset($attivita)
                @foreach($attivita as $att)
                <li class="mb-4"><p class="font-semibold">{{ $att['attivita']->nome ." (". $att['freq'] . ")"}}</p>
                    <p class="text-gray-500">{{ $att['attivita']->descr}}</p>
                @endforeach
            @endisset

            @if($attivita == null)
                <li><p class="font-semibold mt-2">Non ci sono attività pianificate.</p>
            @endif
        </ul>
    </div>
    <div class="flex-row justify-center space-x-16">
        <a href="{{ route('modificaDiagnosi', ['userPaz' => $paziente->username])}}">
            <button type="button" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500">
                Modifica Diagnosi
            </button>
        </a>
        <a href="{{ route('modificaTerapia', ['userPaz' => $paziente->username])}}">
            <button type="button" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500">
                Modifica Terapia
            </button>
        </a>
    </div>
</div>
<hr class="h-1 my-10 bg-cyan-600 m-28">

@if(!$episodi->isEmpty())
<h2 class="text-3xl font-bold ml-5 mt-5 mb-8">Episodi registrati</h2>
<div class="flex mx-[15%] justify-between">
    <div name="filtro1" class="space-x-2 flex items-center">
        <p class="h-min text-lg font-semibold">Filtra per disturbo: </p>

        <select name="filtroDisturbo[]" multiple class="inline bg-white rounded-md h-min min-w-[100px] p-1 border border-cyan-600" size=2>
            @isset($disturbiSel)
                @foreach($disturbiSel as $disturboSel)
                    <option value="{{ $disturboSel->nome}}">{{ $disturboSel->nome}}</option>
                @endforeach
            @endisset
        </select>
    </div>
    <div name="filtro2" class="space-x-2 flex items-center">
        <p class="text-lg font-semibold">Filtra per intensità:</p>
        <div class="flex space-x-1 items-center">
            <p>min</p>
            <select name="filtroMin" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                <option value="0" selected>0</option>
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
        <div class="flex space-x-1 items-center">
            <p>max</p>
            <select name="filtroMax" class="bg-white inline h-min rounded-md p-1 w-min border border-cyan-600 text-center text-xs">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10" selected>10</option>
            </select>
        </div>
    </div>
</div>
<div class=" text-lg container mx-auto p-4 w-full max-w-4xl mt-6">

    @isset($episodi)
    @foreach ($episodi as $episodio)
        <div class="flex justify-between items-center bg-white p-4 rounded-lg mb-2" data-disturbo="{{$episodio->disturbo->nome}}" data-intensita="{{$episodio->intensita}}">
            <div class="flex flex-row space-x-2">
                <p class="font-bold">{{ $episodio->disturbo->nome }}</p>
                <p class="text-gray-500 font-semibold">{{"(Intensità:" . $episodio->intensita . ")"}}</p>
            </div>
            <p class="text-gray-500">del {{\Carbon\Carbon::parse($episodio->data)->format('d-m-Y')}} alle {{\Carbon\Carbon::parse($episodio->ora)->format('H:i')}}</p>
        </div>
    @endforeach
    @endisset
    @endif

    @if($episodi->isEmpty())
    <div class="flex justify-center">
        <h2 class="text-2xl font-bold ml-5 mt-2 mb-12">Gli episodi registrati verranno mostrati qui</h2>
    </div>
    @endif

    

</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {

        elem_id = "back_button";
        rotta = "{{ route('listaPazienti') }}";
        sovrascriviOnClick(elem_id,rotta);

        // -- Meccanismo di filtro --
        var disturbiSelect = $('select[name="filtroDisturbo[]"]');
        var minFiltro = $('select[name="filtroMin"]');
        var maxFiltro = $('select[name="filtroMax"]');
        console.log(disturbiSelect);

        function filtraEpisodi() {

            // estraggo valori dai tre filtri
            var distSelezionati = disturbiSelect.val();
            console.log('Disturbi selezionati:', distSelezionati); 
            var minimo = parseInt(minFiltro.val());  
            var massimo = parseInt(maxFiltro.val());

            $('div[data-disturbo]').each(function() { // su ogni div itero per vedere se deve essere mostrato o meno

                var disturbo = $(this).data('disturbo');
                var intensita = $(this).data('intensita');
                var distMatch = (!distSelezionati.length || distSelezionati.includes(disturbo));
                // ho incluso il caso in cui non ci siano disturbi selezionati, in tal caso distMatch è true
                
                var intensitaMatch = intensita >= minimo && intensita <= massimo;

                if (distMatch && intensitaMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            })
            
        }


        disturbiSelect.change(filtraEpisodi);
        minFiltro.change(filtraEpisodi);
        maxFiltro.change(filtraEpisodi);

        filtraEpisodi(); // non dovrebbe servire, ma per sicurezza


    })
</script>
@endsection