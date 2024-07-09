@extends('layouts.basic')

@section('title', 'FAQ')

@section('scripts')

@parent
<script>
    $(document).ready(function(){
        
        $(".faq").each(function(){
            $(this).find("#arrow").click(function(){
                $(this).parent().next().slideToggle(); // next prende il div successivo al div genitore di arrow
            });
        });
    });
</script>
@endsection

@section('content')
<div class="flex flex-row flex-nowrap">
    <div name="textring" class="basis-1/3 items-center mt-10">
        <div class="font-bold text-5xl absolute z-10 pl-16 pt-36 text-gray-800">
            <p class="mb-4">Frequently</p>
            <p class="mb-4">Asked</p>
            <p>Questions</p>
        </div>
        <img src="{{ asset('images/anello.png')}}" class="z-0 h-[500px] pt-5" alt="Decoration">
    </div>
    <div name="q&a" class="basis-2/3 mt-24">
        
        @isset($faqs)
        @foreach($faqs as $faq)
        @if($faq)
            <div name="card" class="faq bg-white shadow rounded-2xl my-3 mr-8 p-6 flex flex-col">
                <div class="items-center justify-between flex flex-row">
                    <h2 class="font-semibold text-gray-800">{{$faq->domanda}}</h2>
                    <img src="{{ asset('images/down.png')}}" id="arrow" class="h-8 cursor-pointer" alt="Down Arrow">
                </div>
                <div id="answer" class="hidden mt-2">
                    <p class="text-gray-500">{{$faq->risposta}}</p>
                </div>
            </div>
        @endif
        @endforeach
        @endisset
    </div>
</div>
<div class="flex justify-center">
    <hr class="h-[3px] rounded bg-cyan-500 my-8 w-[70%]">
</div>
<div name="contact" class="flex justify-center">
    <div name="contact form" class="absolute flex flex-col justify-center h-full items-center z-10">
        <h1 class="font-bold text-5xl text-gray-800">Hai altre domande? Contattaci</h1>
        <p class="text-center text-2xl p-[100px] pb-20">Le risposte alle domande più frequenti potrebbero non essere sufficienti <br>per 
            chiarire i tuoi dubbi. Se hai bisogno di ulteriori informazioni, non esitare<br> a contattarci
            mandandoci un messaggio all'indirizzo email che trovi qui sotto. Sarà nostra premura risponderti
            al più presto possibile.
        </p>
        <!--
        <form class="flex flex-col mt-20 items-center">
            @csrf
            <div class="mb-6">
                <label for="email" class="font-semibold">E-Mail</label>
                <br>
                <input id="email" type="text" class="border rounded-md h-[30px] w-[336px] bg-transparent p-2">
            </div>
            <div class="mb-6">
                <label for="nome" class="font-semibold">Il tuo nome</label>
                <br>
                <input id="nome" type="text" class="border rounded-md h-[30px] w-[336px] bg-transparent p-2">
            </div>
            <div>
                <label for="messaggio" class="font-semibold">Messaggio</label>
                <br>
                <textarea id="messaggio" placeholder="Scrivi qui il tuo messaggio" class="border rounded-md h-[150px] w-[336px] bg-transparent align-top p-2 resize-none"></textarea>
            </div>
            <input type="submit" class="bg-cyan-600 rounded-xl mt-8 w-[200px] h-[60px] text-white font-semibold cursor-pointer" value="Invia Messaggio">
        </form>
        -->
        <a href="mailto:info@neuroclinic.it">
            <button type="button" class="p-3 bg-cyan-600 rounded-lg text-white text-xl hover:bg-cyan-500">
                Scrivi una mail
            </button>
        </a>
    </div>
</div>
<div class="flex justify-end">
    <img src="{{ asset('images/riccio.png')}}" class="h-[700px] z-0" alt="Decoration">
</div>
<footer>
    <div class="bg-cyan-600 w-auto h-[200px] justify-between items-center flex p-8">
        <div> 
            <a href="{{ route('home') }}">
                <img src="images/logo_bianco.svg" class="h-20" alt="Logo">
            </a>
        </div>
        <div>
            <h4 class="font-bold text-white text-xl mr-8">Informazioni di Contatto</h4>
            <br>
            <div class="flex items-center space-x-1">
                <img src="{{ asset('images/location_pin.png')}}" class="h-4">
                <p class="font-sans text-white">Piazza Enrico Malatesta, 1 60121 Ancona (AN)</p>
            </div>
            <div class="flex items-center space-x-1">
                <img src="{{ asset('images/phone.png')}}" class="h-4">
                <p class="font-sans text-white">Tel <a href="tel:3549783214">+39 354 978 3214</a></p>
            </div>
            <div class="flex items-center space-x-1">
                <img src="{{ asset('images/email.png')}}" class="h-4">
                <p class="font-sans text-white">Email <a href="mailto:info@neuroclinic.it">info@neuroclinic.it</a></p>
            </div>
        </div>
    </div>
</footer>
@endsection
