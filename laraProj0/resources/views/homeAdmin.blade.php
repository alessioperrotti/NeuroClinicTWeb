@extends('layouts.area_riservata')

@section('content')

<h1 class="p-10 text-5xl font-bold">Benvenuto, Admin</h1>
<div class="flex justify-center">
    <div class="m-8 ">
        <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square size-60 ">
            <a href= "">
                <img src="images/question.svg" class="size-60" alt="Clinici">
            </a>
        </div>
        <h2 class="p-2 text-3xl" >Gestione clinici</h2>
    </div>
    <div class="m-8 ">
        <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
            <a href="">
                <img src="images/medicina.svg" class="size-60" alt="Clinici">
            </a>
        </div>
        <h2 class="p-2 text-3xl">Farmaci e attività<br>riabilitative</h2>
    </div>
    <div class="m-8 ">
        <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
            <a href="{{route('analisiDati')}}">
                <img src="images/grafico.svg" class="size-60" alt="Clinici">
            </a>
        </div>
        <h2 class="p-2 text-3xl">Analisi dati</h2>
    </div>
</div>


<div class="flex justify-center">
    <div class="m-8 text-3xl">
        <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
            <a href=>
                <img src="images/icona_stamp.svg" class="size-60" alt="Clinici">
            </a>
        </div>
        <h2 class="p-2 text-3xl">Gestione disturbi<br>motori</h2>
    </div>
    <div class="m-8 text-3xl">
        <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
            <a href="{{route('listaPaz')}}">
                <img src="images/elimina_paziente.svg" class="size-60" alt="Clinici">
            </a>
        </div>
        <h2 class="p-2 text-3xl">Elimina pazienti</h2>
    </div>
    <div class="m-8">
        <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
            <a href=>
                <img src="images/dottore.svg" class="size-60" alt="Clinici">
            </a>
        </div>
        <h2 class="p-2 text-3xl">Gestione clinici</h2>
    </div>
</div>


<div></div>
@endsection