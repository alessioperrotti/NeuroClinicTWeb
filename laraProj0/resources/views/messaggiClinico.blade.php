@extends('layouts.basic')

@section('title', 'Messaggi Clinico')


@section('scripts')

@parent
<script>
    $(document).ready(function(){

        $("#ricevuti").addClass("flex-grow").removeClass("basis-3/5");
        
        $("#a_ricevuti").click(function(){
            $("#ricevuti").removeClass("hidden basis-3/5").addClass("flex-grow");
            $("#inviati").addClass("hidden basis-3/5").removeClass("flex-grow");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });

        $("#a_inviati").click(function(){
            $("#ricevuti").addClass("hidden basis-3/5").removeClass("flex-grow");
            $("#inviati").removeClass("hidden basis-3/5").addClass("flex-grow");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
        });

        $("#a_nuovo").click(function(){
            $("#nuovo").removeClass("hidden").addClass("basis-2/5");
            $("#ricevuti, #inviati").removeClass("flex-grow").addClass("basis-3/5");
        });

        $("#submit").click(function(){
            alert("Messaggio inviato con successo!");
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
            $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-3/5");
        });

        $("#reset").click(function(){
            $("#nuovo").addClass("hidden").removeClass("basis-2/5");
            $("#ricevuti, #inviati").addClass("flex-grow").removeClass("basis-3/5");
        });
        
    });
</script>
@endsection

@section('content')
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Messaggi con i pazienti</h1>
<div class="bg-white rounded-xl shadow-md mx-10 p-8 mb-12">
    <div class="flex flex-row justify-left space-x-4">  
        <a id="a_ricevuti" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Ricevuti</a>
        <a id="a_inviati" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl font-semibold">Inviati</a>
        <a id="a_nuovo" class="hover:bg-gray-300 p-1 rounded-md cursor-pointer text-xl text-cyan-600 font-semibold">Nuovo Messaggio</a>
    </div>
    <hr class="h-0.5 mt-1 mb-4 bg-cyan-600">
    <div class="flex">
        <div id="ricevuti" class="messaggi relative min-h-[400px]">
            @if($messaggiRic->isEmpty())
                <div class="flex justify-center items-center h-[400px] w-full text-center">
                    <h2 class="text-2xl text-gray-700 font-semibold ml-5 mt-2 mb-12">I messaggi ricevuti compariranno qui</h2>
                </div>
            @endif
            @isset($messaggiRic)
                @foreach($messaggiRic as $msgR)
                    <div class="border rounded-md">
                        <div class="flex flex-row justify-between">
                            <h3 class="font-bold text-2xl">Da {{ $msgR->mittente->nome . " " . $msgR->mittente->cognome}}</h3>
                            <p class="text-gray-500">{{ $msgR->created_at}}</p>
                        </div>
                        <p class="text-gray-600">{{ $msgR->contenuto}}</p>
                    </div>
                @endforeach
            @endisset
        </div>
        <div id="inviati" class="messaggi hidden relative min-h-[400px]">
            @if($messaggiInv->isEmpty())
                <div class="flex justify-center items-center h-[400px] w-full text-center">
                    <h2 class="text-2xl text-gray-700 font-semibold ml-5 mt-2 mb-12">I messaggi inviati compariranno qui</h2>
                </div>
            @endif
            @isset($messaggiInv)
                @foreach($messaggiInv as $msgI)
                    <div class="border rounded-md">
                        <div class="flex flex-row justify-between px-4 py-1">
                            <h3 class="font-semibold">A: {{ $msgI->destin->nome . " " . $msgI->destin->cognome}}</h3>
                            <p class="text-gray-500">{{ $msgI->created_at}}</p>
                        </div>
                        <p class="text-gray-600 px-4">{{ $msgI->contenuto}}</p>
                    </div>
                @endforeach
            @endisset
        </div>
        <div id="nuovo" class="inline hidden messaggi border p-8 flex-grow"> 
            <form class="flex flex-col justify-center" method="POST" action="{{ route('messaggioClinico.send')}}">
                @csrf
                <div>
                    <label for="destin" class="font-semibold">Destinatario</label>
                    <select name="destin" class="mt-1 block w-full p-2 border border-gray-300 rounded-md mb-4">
                    @isset($pazienti)
                        @foreach($pazienti as $paziente)
                            <option value={{$paziente->username}} class="text-gray-700">{{$paziente->nome . " " . $paziente->cognome}}</option>
                        @endforeach
                    @endisset
                    </select>
                    <label for="messaggio" class="font-semibold mt-4">Messaggio</label>
                    <textarea name="contenuto" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-[150px] resize-none" placeholder="Scrivi qui il tuo messaggio"></textarea>
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