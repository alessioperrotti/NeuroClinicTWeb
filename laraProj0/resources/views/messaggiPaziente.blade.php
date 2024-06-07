@extends('layouts.basic')

@section('title', 'Messaggi Paziente')


@section('scripts')

@parent
<script>
    $(document).ready(function() {

        var backButton = document.getElementById('back_button');
        backButton.onclick = function() {
            window.location.href = "{{ route('homePaziente') }}";
        };

        $("#ricevuti").addClass("flex-grow").removeClass("basis-3/5");

        $("#a_ricevuti").click(function() {
            $("#ricevuti").removeClass("hidden basis-3/5").addClass("flex-grow");
            $("#inviati").addClass("hidden basis-3/5").removeClass("flex-grow");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });

        $("#a_inviati").click(function() {
            $("#ricevuti").addClass("hidden basis-3/5").removeClass("flex-grow");
            $("#inviati").removeClass("hidden basis-3/5").addClass("flex-grow");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });

        $("#a_nuovo").click(function() {
            $("#nuovo").removeClass("hidden").addClass("basis-2/5");
            $("#ricevuti, #inviati").removeClass("flex-grow").addClass("basis-3/5");
        });

        $("#submit").click(function() {
            if ($("#contenuto").val() == "") {
                alert("Compila tutti i campi!");
                return false;
            } else {
                alert("Messaggio inviato con successo!");
                $("#nuovo").addClass("hidden").removeClass("basis-2/5");
                $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-3/5");
            }

        });

        $("#reset").click(function() {
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
            $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-3/5");
        });

    });
</script>
@endsection

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Messaggi con il tuo clinico</h1>
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
            <div class="bg-gray-50 rounded-lg shadow-md pb-1 mb-2">
                <div class="flex flex-row justify-between px-4 pt-1">
                    <h3 class="font-semibold">Da {{ $msgR->mittente->nome . " " . $msgR->mittente->cognome}}</h3>
                    <p class="text-gray-500">{{ $msgR->created_at}}</p>
                </div>
                <p class="text-gray-600 px-4">{{ $msgR->contenuto}}</p>
            </div>
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
            <div class="bg-gray-50 rounded-lg shadow-md pb-1 mb-2">
                <div class="flex flex-row justify-between px-4 pt-1">
                    <h3 class="font-semibold">A: {{ $msgI->destin->nome . " " . $msgI->destin->cognome}}</h3>
                    <p class="text-gray-500">{{ $msgI->created_at}}</p>
                </div>
                <p class="text-gray-600 px-4">{{ $msgI->contenuto}}</p>
            </div>
            @endforeach
            @endisset
        </div>
        <div id="nuovo" class="inline hidden messaggi border-l-2 border-gray-200 ml-8 p-8 flex-grow">
            <form class="flex flex-col justify-center" method="POST" action="{{ route('messaggioPaziente.send')}}">
                @csrf
                <div>
                    <input type="hidden" name="destin" value="{{$clinico->username}}">
                    <label for="messaggio" class="font-semibold mt-4">Messaggio</label>
                    <textarea id="contenuto" name="contenuto" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-[150px] resize-none" placeholder="Scrivi qui il tuo messaggio"></textarea>
                    <div class="flex flex-col justify-center items-center">
                        <input id="submit" type="submit" class="bg-cyan-600 hover:bg-cyan-500 rounded-md mt-6 w-[150px] h-[35px] text-white cursor-pointer" value="Invia Messaggio">
                        <input id="reset" type="reset" class="bg-gray-500 hover:bg-gray-400 rounded-md mt-4 w-[150px] h-[35px] text-white cursor-pointer" value="Annulla">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection