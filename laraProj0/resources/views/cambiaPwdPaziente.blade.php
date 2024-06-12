@extends('layouts.basic')

@section('title', 'Cambia Password')



@section('content')
<div class="flex flex-col items-center justify-center gap-y-2">
    <h1 class="text-black font-bold text-5xl mx-8 mt-4">Modifica password</h1>
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-xl shadow-lg mt-12">
        <div class="card-body">
            
            <form method="POST" action="{{ route('password.update')}}" class="mb-10">
                @csrf

                <label for="vecchiaPwd" class="block text-gray-700 font-semibold text-xl">Vecchia Password</label>
                <div class="relative">
                    <input id="vecchiaPwd" name="vecchiaPassword" type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2 ">
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-700" onclick="togglePassword('vecchiaPwd', 'eyeId1')">
                        <img id="eyeId1" src="{{asset('images/eye-solid.png')}}" alt="toggle" class="w-5">
                    </button>
                </div>

               

                @if ($errors->first('vecchiaPassword'))
                    {{$message=$errors->get('vecchiaPassword')}}
                    <ul class="errors">
                        <li><strong>{{ $message }}</strong></li>
                    </ul>
                @endif

                <label for="nuovaPwd" class="block text-gray-700 font-semibold text-xl">Nuova Password</label>
                <div class="relative">
                    <input id="nuovaPwd" name="nuovaPassword" type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2 " >
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-700" onclick="togglePassword('nuovaPwd', 'eyeId2')">
                        <img id="eyeId2" src="{{asset('images/eye-solid.png')}}" alt="toggle" class="w-5">
                    </button>
                </div>

               
                @if ($errors->first('nuovaPassword'))
                    {{$message=$errors->get('nuovaPassword')}}
                    <ul class="errors">
                        <li><strong>{{ $message }}</strong></li>
                    </ul>
                @endif

                <label for="confermaPwd" class="block text-gray-700 font-semibold text-xl">Conferma Nuova Password</label>
                <div class="relative">
                    <input id="confermaPwd" name="confermaPassword" type="password" class="border-black border bg-cyan-100 w-full my-3 rounded-xl pl-2 " >
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-700" onclick="togglePassword('confermaPwd', 'eyeId3')">
                        <img id="eyeId3" src="{{asset('images/eye-solid.png')}}" alt="toggle" class="w-5">
                    </button>
                </div>

                
                @if ($errors->first('confermaPassword'))
                    {{$message=$errors->get('confermaPassword')}}
                    <ul class="errors">
                        <li><strong>{{ $message }}</strong></li>
                    </ul>
                @endif

                <div class="flex justify-center mt-4 gap-y-4 4  gap-x-24">
                    <input name="annulla" type="reset" value="Annulla Modifiche" class="cursor-pointer bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400">
                    <input name="conferma" type="submit" value="Conferma Modifiche" class="cursor-pointer bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500">
                </div>
            </form>
        </div>
    </div>


    @endsectionz