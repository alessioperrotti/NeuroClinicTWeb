@extends('layouts.basic')
@section('title', 'Aggiornamento Dati Paziente')

@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-black font-bold text-5xl mx-8 mt-4">Aggiorna dati</h1>
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">

        <form id="aggiorna-form" method="POST" action="{{ route('paziente.update', $paziente->username)}}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                <div>
                    <label class="block text-gray-700 font-semibold">Nome</label>
                    <input id="nome" name="nome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->nome}}" >
                </div>

                <div>
                    <label class="block text-gray-700">Cognome</label>
                    <input id="cognome" name="cognome" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->cognome}}" >
                </div>

                <div>
                    <label class="block text-gray-700">Data di nascita</label>
                    <input id="dataNasc" name="dataNasc" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->dataNasc}}" >
                    
                </div>

                <div>
                    <label class="block text-gray-700">Genere</label>
                    <select id="genere" name="genere" size="1" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
                        <option value="M"  {{ $paziente->genere == 'M' ? 'selected' : '' }}>Uomo</option>
                        <option value="F"  {{ $paziente->genere == 'F' ? 'selected' : '' }}>Donna</option>
                        <option value="A"  {{ $paziente->genere == 'A' ? 'selected' : '' }}>Altro</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Via</label>
                    <input id="via" name="via" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->via}}" >
                    
                </div>

                <div>
                    <label class="block text-gray-700">Civico</label>
                    <input id="civico" name="civico" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->civico}}" >
                    
                </div>

                <div>
                    <label class="block text-gray-700">Città</label>
                    <input id="citta" name="citta" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->citta}}" >
                    
                </div>

                <div>
                    <label class="block text-gray-700">Provincia</label>
                    <select id="prov" name="prov" size="1" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
                        <option value="AG"  {{ $paziente->prov == 'AG' ? 'selected' : '' }}>Agrigento</option>
                        <option value="AL"  {{ $paziente->prov == 'AL' ? 'selected' : '' }}>Alessandria</option>
                        <option value="AN"  {{ $paziente->prov == 'AN' ? 'selected' : '' }}>Ancona</option>
                        <option value="AO"  {{ $paziente->prov == 'AO' ? 'selected' : '' }}>Aosta</option>
                        <option value="AR"  {{ $paziente->prov == 'AR' ? 'selected' : '' }}>Arezzo</option>
                        <option value="AP"  {{ $paziente->prov == 'AP' ? 'selected' : '' }}>Ascoli Piceno</option>
                        <option value="AT"  {{ $paziente->prov == 'AT' ? 'selected' : '' }}>Asti</option>
                        <option value="AV"  {{ $paziente->prov == 'AV' ? 'selected' : '' }}>Avellino</option>
                        <option value="BA"  {{ $paziente->prov == 'BA' ? 'selected' : '' }}>Bari</option>
                        <option value="BT"  {{ $paziente->prov == 'BT' ? 'selected' : '' }}>Barletta-Andria-Trani</option>
                        <option value="BL"  {{ $paziente->prov == 'BL' ? 'selected' : '' }}>Belluno</option>
                        <option value="BN"  {{ $paziente->prov == 'BN' ? 'selected' : '' }}>Benevento</option>
                        <option value="BG"  {{ $paziente->prov == 'BG' ? 'selected' : '' }}>Bergamo</option>
                        <option value="BI"  {{ $paziente->prov == 'BI' ? 'selected' : '' }}>Biella</option>
                        <option value="BO"  {{ $paziente->prov == 'BO' ? 'selected' : '' }}>Bologna</option>
                        <option value="BZ"  {{ $paziente->prov == 'BZ' ? 'selected' : '' }}>Bolzano</option>
                        <option value="BS"  {{ $paziente->prov == 'BS' ? 'selected' : '' }}>Brescia</option>
                        <option value="BR"  {{ $paziente->prov == 'BR' ? 'selected' : '' }}>Brindisi</option>
                        <option value="CA"  {{ $paziente->prov == 'CA' ? 'selected' : '' }}>Cagliari</option>
                        <option value="CL"  {{ $paziente->prov == 'CL' ? 'selected' : '' }}>Caltanissetta</option>
                        <option value="CB"  {{ $paziente->prov == 'CB' ? 'selected' : '' }}>Campobasso</option>
                        <option value="CI"  {{ $paziente->prov == 'CI' ? 'selected' : '' }}>Carbonia-Iglesias</option>
                        <option value="CE"  {{ $paziente->prov == 'CE' ? 'selected' : '' }}>Caserta</option>
                        <option value="CT"  {{ $paziente->prov == 'CT' ? 'selected' : '' }}>Catania</option>
                        <option value="CZ"  {{ $paziente->prov == 'CZ' ? 'selected' : '' }}>Catanzaro</option>
                        <option value="CH"  {{ $paziente->prov == 'CH' ? 'selected' : '' }}>Chieti</option>
                        <option value="CO"  {{ $paziente->prov == 'CO' ? 'selected' : '' }}>Como</option>
                        <option value="CS"  {{ $paziente->prov == 'CS' ? 'selected' : '' }}>Cosenza</option>
                        <option value="CR"  {{ $paziente->prov == 'CR' ? 'selected' : '' }}>Cremona</option>
                        <option value="KR"  {{ $paziente->prov == 'KR' ? 'selected' : '' }}>Crotone</option>
                        <option value="CN"  {{ $paziente->prov == 'CN' ? 'selected' : '' }}>Cuneo</option>
                        <option value="EN"  {{ $paziente->prov == 'EN' ? 'selected' : '' }}>Enna</option>
                        <option value="FM"  {{ $paziente->prov == 'FM' ? 'selected' : '' }}>Fermo</option>
                        <option value="FE"  {{ $paziente->prov == 'FE' ? 'selected' : '' }}>Ferrara</option>
                        <option value="FI"  {{ $paziente->prov == 'FI' ? 'selected' : '' }}>Firenze</option>
                        <option value="FG"  {{ $paziente->prov == 'FG' ? 'selected' : '' }}>Foggia</option>
                        <option value="FC"  {{ $paziente->prov == 'FC' ? 'selected' : '' }}>Forlì-Cesena</option>
                        <option value="FR"  {{ $paziente->prov == 'FR' ? 'selected' : '' }}>Frosinone</option>
                        <option value="GE"  {{ $paziente->prov == 'GE' ? 'selected' : '' }}>Genova</option>
                        <option value="GO"  {{ $paziente->prov == 'GO' ? 'selected' : '' }}>Gorizia</option>
                        <option value="GR"  {{ $paziente->prov == 'GR' ? 'selected' : '' }}>Grosseto</option>
                        <option value="IM"  {{ $paziente->prov == 'IM' ? 'selected' : '' }}>Imperia</option>
                        <option value="IS"  {{ $paziente->prov == 'IS' ? 'selected' : '' }}>Isernia</option>
                        <option value="SP"  {{ $paziente->prov == 'SP' ? 'selected' : '' }}>La Spezia</option>
                        <option value="AQ"  {{ $paziente->prov == 'AQ' ? 'selected' : '' }}>L'Aquila</option>
                        <option value="LT"  {{ $paziente->prov == 'LT' ? 'selected' : '' }}>Latina</option>
                        <option value="LE"  {{ $paziente->prov == 'LE' ? 'selected' : '' }}>Lecce</option>
                        <option value="LC"  {{ $paziente->prov == 'LC' ? 'selected' : '' }}>Lecco</option>
                        <option value="LI"  {{ $paziente->prov == 'LI' ? 'selected' : '' }}>Livorno</option>
                        <option value="LO"  {{ $paziente->prov == 'LO' ? 'selected' : '' }}>Lodi</option>
                        <option value="LU"  {{ $paziente->prov == 'LU' ? 'selected' : '' }}>Lucca</option>
                        <option value="MC"  {{ $paziente->prov == 'MC' ? 'selected' : '' }}>Macerata</option>
                        <option value="MN"  {{ $paziente->prov == 'MN' ? 'selected' : '' }}>Mantova</option>
                        <option value="MS"  {{ $paziente->prov == 'MS' ? 'selected' : '' }}>Massa-Carrara</option>
                        <option value="MT"  {{ $paziente->prov == 'MT' ? 'selected' : '' }}>Matera</option>
                        <option value="VS"  {{ $paziente->prov == 'VS' ? 'selected' : '' }}>Medio Campidano</option>
                        <option value="ME"  {{ $paziente->prov == 'ME' ? 'selected' : '' }}>Messina</option>
                        <option value="MI"  {{ $paziente->prov == 'MI' ? 'selected' : '' }}>Milano</option>
                        <option value="MO"  {{ $paziente->prov == 'MO' ? 'selected' : '' }}>Modena</option>
                        <option value="MB"  {{ $paziente->prov == 'MB' ? 'selected' : '' }}>Monza e della Brianza</option>
                        <option value="NA"  {{ $paziente->prov == 'NA' ? 'selected' : '' }}>Napoli</option>
                        <option value="NO"  {{ $paziente->prov == 'NO' ? 'selected' : '' }}>Novara</option>
                        <option value="NU"  {{ $paziente->prov == 'NU' ? 'selected' : '' }}>Nuoro</option>
                        <option value="OG"  {{ $paziente->prov == 'OG' ? 'selected' : '' }}>Ogliastra</option>
                        <option value="OT"  {{ $paziente->prov == 'OT' ? 'selected' : '' }}>Olbia-Tempio</option>
                        <option value="OR"  {{ $paziente->prov == 'OR' ? 'selected' : '' }}>Oristano</option>
                        <option value="PD"  {{ $paziente->prov == 'PD' ? 'selected' : '' }}>Padova</option>
                        <option value="PA"  {{ $paziente->prov == 'PA' ? 'selected' : '' }}>Palermo</option>
                        <option value="PR"  {{ $paziente->prov == 'PR' ? 'selected' : '' }}>Parma</option>
                        <option value="PV"  {{ $paziente->prov == 'PV' ? 'selected' : '' }}>Pavia</option>
                        <option value="PG"  {{ $paziente->prov == 'PG' ? 'selected' : '' }}>Perugia</option>
                        <option value="PU"  {{ $paziente->prov == 'PU' ? 'selected' : '' }}>Pesaro e Urbino</option>
                        <option value="PE"  {{ $paziente->prov == 'PE' ? 'selected' : '' }}>Pescara</option>
                        <option value="PC"  {{ $paziente->prov == 'PC' ? 'selected' : '' }}>Piacenza</option>
                        <option value="PI"  {{ $paziente->prov == 'PI' ? 'selected' : '' }}>Pisa</option>
                        <option value="PT"  {{ $paziente->prov == 'PT' ? 'selected' : '' }}>Pistoia</option>
                        <option value="PN"  {{ $paziente->prov == 'PN' ? 'selected' : '' }}>Pordenone</option>
                        <option value="PZ"  {{ $paziente->prov == 'PZ' ? 'selected' : '' }}>Potenza</option>
                        <option value="PO"  {{ $paziente->prov == 'PO' ? 'selected' : '' }}>Prato</option>
                        <option value="RG"  {{ $paziente->prov == 'RG' ? 'selected' : '' }}>Ragusa</option>
                        <option value="RA"  {{ $paziente->prov == 'RA' ? 'selected' : '' }}>Ravenna</option>
                        <option value="RC"  {{ $paziente->prov == 'RC' ? 'selected' : '' }}>Reggio Calabria</option>
                        <option value="RE"  {{ $paziente->prov == 'RE' ? 'selected' : '' }}>Reggio Emilia</option>
                        <option value="RI"  {{ $paziente->prov == 'RI' ? 'selected' : '' }}>Rieti</option>
                        <option value="RN"  {{ $paziente->prov == 'RN' ? 'selected' : '' }}>Rimini</option>
                        <option value="RM"  {{ $paziente->prov == 'RM' ? 'selected' : '' }}>Roma</option>
                        <option value="RO"  {{ $paziente->prov == 'RO' ? 'selected' : '' }}>Rovigo</option>
                        <option value="SA"  {{ $paziente->prov == 'SA' ? 'selected' : '' }}>Salerno</option>
                        <option value="SS"  {{ $paziente->prov == 'SS' ? 'selected' : '' }}>Sassari</option>
                        <option value="SV"  {{ $paziente->prov == 'SV' ? 'selected' : '' }}>Savona</option>
                        <option value="SI"  {{ $paziente->prov == 'SI' ? 'selected' : '' }}>Siena</option>
                        <option value="SR"  {{ $paziente->prov == 'SR' ? 'selected' : '' }}>Siracusa</option>
                        <option value="SO"  {{ $paziente->prov == 'SO' ? 'selected' : '' }}>Sondrio</option>
                        <option value="TA"  {{ $paziente->prov == 'TA' ? 'selected' : '' }}>Taranto</option>
                        <option value="TE"  {{ $paziente->prov == 'TE' ? 'selected' : '' }}>Teramo</option>
                        <option value="TR"  {{ $paziente->prov == 'TR' ? 'selected' : '' }}>Terni</option>
                        <option value="TO"  {{ $paziente->prov == 'TO' ? 'selected' : '' }}>Torino</option>
                        <option value="TP"  {{ $paziente->prov == 'TP' ? 'selected' : '' }}>Trapani</option>
                        <option value="TN"  {{ $paziente->prov == 'TN' ? 'selected' : '' }}>Trento</option>
                        <option value="TV"  {{ $paziente->prov == 'TV' ? 'selected' : '' }}>Treviso</option>
                        <option value="TS"  {{ $paziente->prov == 'TS' ? 'selected' : '' }}>Trieste</option>
                        <option value="UD"  {{ $paziente->prov == 'UD' ? 'selected' : '' }}>Udine</option>
                        <option value="VA"  {{ $paziente->prov == 'VA' ? 'selected' : '' }}>Varese</option>
                        <option value="VE"  {{ $paziente->prov == 'VE' ? 'selected' : '' }}>Venezia</option>
                        <option value="VB"  {{ $paziente->prov == 'VB' ? 'selected' : '' }}>Verbano-Cusio-Ossola</option>
                        <option value="VC"  {{ $paziente->prov == 'VC' ? 'selected' : '' }}>Vercelli</option>
                        <option value="VR"  {{ $paziente->prov == 'VR' ? 'selected' : '' }}>Verona</option>
                        <option value="VV"  {{ $paziente->prov == 'VV' ? 'selected' : '' }}>Vibo Valentia</option>
                        <option value="VI"  {{ $paziente->prov == 'VI' ? 'selected' : '' }}>Vicenza</option>
                        <option value="VT"  {{ $paziente->prov == 'VT' ? 'selected' : '' }}>Viterbo</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Telefono</label>
                    <input id="telefono" name="telefono" type="tel" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->telefono}}">
                    
                </div>

                <div>
                    <label class="block text-gray-700">E-Mail</label>
                    <input id="email" name="email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $paziente->email}}">
                    
                </div>                
            </div>
            <div class="flex justify-center mt-8 gap-y-4 4  gap-x-24">
                <input name="annulla" type="reset" value="Annulla Modifiche" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 cursor-pointer"></input>
                <input name="conferma" type="submit" value="Conferma Modifiche" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500 cursor-pointer "></input>
            </div>
        </form>
    </div>
</div>    

<script src="{{ asset('js/functions.js') }}"></script>

<script>
    
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

    $(function() {
        var actionUrl = "{{ route('paziente.update',  $paziente->username) }}";
        var formId = 'aggiorna-form';
        setupValidation(actionUrl, formId);
    });
    
</script>
@endsection