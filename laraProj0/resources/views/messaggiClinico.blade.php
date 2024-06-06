@extends('layouts.basic')

@section('title', 'Messaggi Clinico')


@section('scripts')

@parent
<script>
    $(document).ready(function(){
        
        $("#a_ricevuti").click(function(){
            $("#ricevuti").removeClass("hidden").addClass("basis-3/5");
            $("#inviati").addClass("hidden").removeClass("basis-3/5");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });

        $("#a_inviati").click(function(){
            $("#ricevuti").addClass("hidden").removeClass("basis-3/5");
            $("#inviati").removeClass("hidden").addClass("basis-3/5");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });

        $("#a_nuovo").click(function(){
            $("#nuovo").removeClass("hidden").addClass("basis-2/5");
        });

        $("#submit").click(function(){
            alert("Messaggio inviato con successo!");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });
        
    });
</script>
@endsection

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Messaggi con i pazienti</h1>
<div class="bg-white rounded-xl shadow-md mx-10 p-8 mb-12">
    <div class="flex flex-row justify-left space-x-4">  <!-- con js aggiungere basis 3/5 -->
        <a id="a_ricevuti" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Ricevuti</a>
        <a id="a_inviati" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Inviati</a>
        <a id="a_nuovo" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl text-cyan-600 font-semibold">Nuovo Messaggio</a>
    </div>
    <hr class="h-0.5 my-1 bg-cyan-600">
    <div class="flex">
        <div id="ricevuti" class="messaggi border relative">
            @if($messaggiRic->isEmpty())
                <div class="flex justify-center items-center h-[400px] w-[800px]">
                    <h2 class="text-2xl font-semibold ml-5 mt-2 mb-12">I messaggi ricevuti compariranno qui</h2>
                </div>
            @endif
            @isset($messaggiRic)
                @foreach($messaggiRic as $msgR)
                    <div class="flex flex-row justify-between">
                        <h3 class="font-bold text-2xl">Da {{ $msgR->mittente->nome . " " . $msgR->mittente->cognome}}</h3>
                        <p class="text-gray-500">{{ $msgR->created_at}}</p>
                    </div>
                    <p class="text-gray-600">{{ $msgR->testo}}</p>
                @endforeach
            @endisset
        </div>
        <div id="inviati" class="messaggi hidden border relative">
            @if($messaggiInv->isEmpty())
                <div class="flex justify-center items-center h-[400px] w-[800px]">
                    <h2 class="text-2xl font-semibold ml-5 mt-2 mb-12">I messaggi inviati compariranno qui</h2>
                </div>
            @endif
            @isset($messaggiInv)
                @foreach($messaggiInv as $msgI)
                    <div class="flex flex-row justify-between">
                        <h3 class="font-bold text-2xl">Da {{ $msgI->mittente->nome . " " . $msgI->mittente->cognome}}</h3>
                        <p class="text-gray-500">{{ $msgI->created_at}}</p>
                    </div>
                    <p class="text-gray-600">{{ $msgI->testo}}</p>
                @endforeach
            @endisset
        </div>
        <div id="nuovo" class="inline hidden messaggi border p-8 flex-grow"> <!-- con js aggiungere basis 2/5 -->
            <form class="flex flex-col justify-center">
                @csrf
                <div>
                    <label for="destinatario" class="font-semibold">Destinatario</label>
                    <select class="mt-1 block w-full p-2 border border-gray-300 rounded-md mb-4">
                    @isset($pazienti)
                        @foreach($pazienti as $paziente)
                            <option value={{$paziente->username}} class="text-gray-700">{{$paziente->nome . " " . $paziente->cognome}}</option>
                        @endforeach
                    @endisset
                    </select>
                    <label for="messaggio" class="font-semibold mt-4">Messaggio</label>
                    <input type="textarea" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-[150px]" placeholder="Scrivi qui il tuo messaggio">
                    <div class="flex flex-col justify-center items-center">
                        <input id="submit" type="submit" class="bg-cyan-600 hover:bg-cyan-500 rounded-md mt-6 w-[150px] h-[35px] text-white cursor-pointer" value="Invia Messaggio">
                        <input type="reset" class="bg-gray-500 hover:bg-gray-400 rounded-md mt-4 w-[150px] h-[35px] text-white cursor-pointer" value="Annulla">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection