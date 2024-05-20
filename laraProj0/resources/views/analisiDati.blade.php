@extends('layouts.basic')

@section('content')



<div class='m-4 px-10'>
    <div class='flex justify-center'>
        <h1 class='text-5xl font-bold mx-5 mb-8'>Analisi dei dati</h1>
    </div>

    <div class="flex">

        <div class='bg-white text-lg w-1/2 px-5 '>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Media pazienti per clinico</h2>
                <h2>10</h2>
            </div>
            <hr>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Media disturbi motori registrati per paziente</h2>
                <h2>10</h2>
            </div>
            <hr>
            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Disturbo motorio</h2>
                <select class="w-1/4">
                    <option>Prova1</option>
                    <option>Prova2</option>
                </select>
            </div>

            <div class='flex justify-between px-5 gap-x-4 py-3'>
                <h2 class='w-1/3 font-semibold'>Numero di eventi totali registrati</h2>
                <h2>10</h2>
            </div>
            <hr>
        </div>



        <div class="w-1/2 pl-10 items-center ">
            <input class="w-full" type="text" id="cognomeClinico" placeholder="Cerca per cognome" class=" bg-cyan-50 my-6 appearance-none w-full py-2 px-3
                 border-0 border-b-2 border-gray-300 focus:border-black
                  text-gray-700 leading-tight  focus:outline-none">
            <div class="bg-white">

                <!-- <table class = "table-fixed w-max">
                    <tr class="w-max flex justify-between"> 
                        <th scope="col">Paziente</th>
                        <th scope="col">Numero cambi terapia</th>
                        
                    </tr>
                </table>  da rivedere-->


            </div>


        </div>





        @endsection