@extends('layouts.basic')

@section('title', 'Messaggi Clinico')


@section('scripts')

@parent
<script>
    $(document).ready(function() {

        var backButton = document.getElementById('back_button');
        backButton.onclick = function() {
            window.location.href = "{{ route('homeClinico') }}";
        };

        $("#ricevuti").addClass("flex-grow").removeClass("basis-4/6");

        $("#a_ricevuti").click(function() {
            $("#ricevuti").removeClass("hidden basis-4/6").addClass("flex-grow");
            $("#inviati").addClass("hidden basis-4/6").removeClass("flex-grow");
            $("#nuovo").addClass("hidden").removeClass("basis-2/6");
            $("#nuovo_risp").addClass("hidden").removeClass("basis-2/6");

        });

        $("#a_inviati").click(function() {
            $("#ricevuti").addClass("hidden basis-4/6").removeClass("flex-grow");
            $("#inviati").removeClass("hidden basis-4/6").addClass("flex-grow");
            $("#nuovo").addClass("hidden").removeClass("basis-2/6");
            $("#nuovo_risp").addClass("hidden").removeClass("basis-2/6");


        });

        $("#a_nuovo").click(function() {
            $("#nuovo_risp").addClass("hidden").removeClass("basis-2/6");
            $("#nuovo").removeClass("hidden").addClass("basis-2/6");
            $("#ricevuti, #inviati").removeClass("flex-grow").addClass("basis-4/6");
        });


        $(".a_nuovo_risp").click(function() {
            $("#nuovo").addClass("hidden").removeClass("basis-2/6");
            $("#nuovo_risp").removeClass("hidden").addClass("basis-2/6");
            $("#ricevuti, #inviati").removeClass("flex-grow").addClass("basis-4/6");
            var idRisp = $(this).data('idrisp');
            var Mitt = $(this).data('mitt');
            var idData = $(this).data('iddata');
            var idMitt = $(this).data('idmitt');

            $("#destin_risp").val(idMitt);
            $("#risposta_rif").text("Rispondi al messaggio di " + Mitt + " del " + idData);
            $("#risposta").val(idRisp);

        });


        $("#submit").click(function() {
            if ($("#contenuto").val() == "" || $("#destin").val() == "") {
                alert("Compila tutti i campi!");
                return false;
            } else {
                alert("Messaggio inviato con successo!");
                $("#nuovo").addClass("hidden").removeClass("basis-2/6");
                $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-4/6");
            }

        });


        $("#reset").click(function() {
            $("#nuovo").addClass("hidden").removeClass("basis-2/6");
            $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-4/6");
        });

        $("#submit_risp").click(function() {
            if ($("#contenuto_risp").val() == "") {
                alert("Compila tutti i campi!");
                return false;
            } else {
                alert("Messaggio inviato con successo!");
                $("#nuovo_risp").addClass("hidden").removeClass("basis-2/6");
                $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-4/6");
            }
        });

        $("#reset_risp").click(function() {
            $("#nuovo_risp").addClass("hidden").removeClass("basis-2/6");
            $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-4/6");
        });

    });
</script>
@endsection

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Messaggi con i pazienti</h1>
<div class="bg-white rounded-xl shadow-md mx-10 pt-8 pr-8 pl-8 pb-2 mb-12">
    <div class="flex flex-row justify-left space-x-4">
        <a id="a_ricevuti" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Ricevuti</a>
        <a id="a_inviati" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Inviati</a>
        <a id="a_nuovo" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl text-cyan-600 font-semibold">Nuovo Messaggio</a>
    </div>
    <hr class="h-0.5 mt-1 mb-4 bg-cyan-600">
    <div class="flex">
        <div id="ricevuti" class="messaggi relative h-[400px] overflow-y-auto">
            @if($messaggiRic->isEmpty())
            <div class="flex justify-center items-center h-[400px] w-full text-center">
                <h2 class="text-2xl text-gray-700 font-semibold ml-5 mt-2 mb-12">I messaggi ricevuti compariranno qui</h2>
            </div>
            @endif
            @isset($messaggiRic)
            @foreach($messaggiRic as $msgR)
                @if($msgR)
                <div class="bg-gray-50 rounded-lg shadow-md pb-1 mb-2">
                    <div class="flex flex-row justify-between px-4 pt-1">
                        <div class="flex">
                            <h3 class="font-semibold">Da: {{ $msgR->mittente->nome . " " . $msgR->mittente->cognome}}</h3>
                        </div>
                        <div class="flex">
                            <p class="text-gray-500">{{ $msgR->created_at}}</p>
                            <button class="a_nuovo_risp mx-2" data-idRisp="{{$msgR->id}}" data-Mitt='{{ $msgR->mittente->nome . " " . $msgR->mittente->cognome}}' data-idData="{{ $msgR->created_at}}" data-idMitt='{{$msgR->mittente->username}}'> Rispondi </button>
                            <p>|</p>
                            <form method="POST" action="{{ route('messaggioClinico.delete', $msgR->id)}}">
                            @csrf
                                <button type="submit" class="mx-2">Elimina</button>
                            </form>
                        </div>
                    </div>
                    @if($msgR->risposta != null)
                        <h3 class="text-gray-400 px-3">{{"[Risposta al tuo messaggio del " . $msgR->risposta->created_at . "]"}}</h3>
                    @endif
                    <p class="text-gray-600 px-4 mt-1">{{ $msgR->contenuto}}</p>
                </div>
                @endif
            @endforeach



            @endisset
        </div>
        <div id="inviati" class="messaggi hidden relative h-[400px] overflow-y-auto">
            @if($messaggiInv->isEmpty())
            <div class="flex justify-center items-center h-[400px] w-full text-center">
                <h2 class="text-2xl text-gray-700 font-semibold ml-5 mt-2 mb-12">I messaggi inviati compariranno qui</h2>
            </div>
            @endif
            @isset($messaggiInv)
            @foreach($messaggiInv as $msgI)
            @if($msgI)
                <div class="bg-gray-50 rounded-lg shadow-md pb-1 mb-2">
                    <div class="flex flex-row justify-between px-4 pt-1">
                        <div class="flex">
                            <h3 class="font-semibold">A: {{ $msgI->destin->nome . " " . $msgI->destin->cognome}}</h3>
                        </div>
                        <div class="flex">
                            <p class="text-gray-500">{{ $msgI->created_at}}</p>
                            <form method="POST" action="{{ route('messaggioClinico.delete', $msgI->id)}}">
                            @csrf
                                <button type="submit" class="mx-2">Elimina</button>
                            </form>
                        </div>
                    </div>
                    @if($msgI->risposta != null)
                    <h3 class="text-gray-400 px-3">{{"[Risposta al messaggio di " . $msgI->risposta->mittente->nome . " del " . $msgI->risposta->created_at . "]"}}</h3>
                    @endif
                    <p class="text-gray-600 px-4 mt-1">{{ $msgI->contenuto}}</p>
                </div>
            @endif
            @endforeach
            @endisset
        </div>
        <div id="nuovo" class="inline hidden messaggi border-l-2 border-gray-200 ml-6 p-6 flex-grow">
            <form class="flex flex-col justify-center" method="POST" action="{{ route('messaggioClinico.send')}}">
                @csrf
                <div>
                    <label for="destin" class="font-semibold">Destinatario</label>
                    <select id="destin" name="destin" class="mt-1 block w-full p-2 border border-gray-300 rounded-md mb-4">
                        @isset($pazienti)
                            @foreach($pazienti as $paziente)
                            @if($paziente)
                                <option value={{$paziente->username}} class="text-gray-700">{{$paziente->nome . " " . $paziente->cognome}}</option>
                            @endif
                            @endforeach
                        @endisset
                        @if($pazienti->isEmpty())
                            <option value="" class="text-gray-700">Nessun paziente disponibile</option>
                        @endif
                    </select>
                    <label for="messaggio" class="font-semibold mt-4">Messaggio</label>
                    <textarea id="contenuto" name="contenuto" maxlength="1000" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-[150px] resize-none" placeholder="Scrivi qui il tuo messaggio"></textarea>
                    <div class="flex flex-col justify-center items-center">
                        <input id="submit" type="submit" class="bg-cyan-600 hover:bg-cyan-500 rounded-md mt-6 w-[150px] h-[35px] text-white cursor-pointer" value="Invia Messaggio">
                        <input id="reset" type="reset" class="bg-gray-500 hover:bg-gray-400 rounded-md mt-4 w-[150px] h-[35px] text-white cursor-pointer" value="Annulla">
                    </div>


                </div>

            </form>


        </div>


        <div id="nuovo_risp" class="inline hidden messaggi border-l-2 border-gray-200 ml-8 p-8 flex-grow">
            <form class="flex flex-col justify-center" method="POST" action="{{ route('messaggioClinico.send')}}">
                @csrf
                <label id="risposta_rif" class="font-semibold mt-4"></label>
                <input id="destin_risp" type="hidden" name="destin" class="mt-1 block w-full p-2 border border-gray-300 rounded-md mb-4" value="">
                <label for="messaggio" class="font-semibold mt-4">Messaggio</label>
                <textarea id="contenuto_risp" name="contenuto" maxlength="1000" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-[150px] resize-none" placeholder="Scrivi qui il tuo messaggio"></textarea>
                <input id="risposta" name="risposta" type="hidden" value="">
                <div class="flex flex-col justify-center items-center">
                    <input id="submit_risp" type="submit" class="bg-cyan-600 hover:bg-cyan-500 rounded-md mt-6 w-[150px] h-[35px] text-white cursor-pointer" value="Invia Messaggio">
                    <input id="reset_risp" type="reset" class="bg-gray-500 hover:bg-gray-400 rounded-md mt-4 w-[150px] h-[35px] text-white cursor-pointer" value="Annulla">
                </div>

            </form>

        </div>
    </div>
</div>

@endsection