@extends('layouts.basic')

@section('title', 'Login')

@section('content')

<div class="flex place-content-center justify-center">
    <div class="bg-white rounded-xl h-[500px] w-[400px] absolute z-10 p-8 mt-[100px]">
        <h1 class="font-bold font-sans text-3xl">Accedi</h1>
        <form>
            <label for="user" class="font-sans my-2">Username</label>
            <br>
            <input id="user" type="text" class="border rounded-sm">
            <br>
            <label for="user" class="">Password</label>
            <br>
            <input id="user" type="text" class="border rounded-sm">
        </form>
    </div>
    <img src="{{ url('images/star3d.png')}}" class="h-[700px] z-0" alt="Sfondo Login">
</div>

<!--
<div class="flex justify-center items-center h-screen">
    
    <div class="bg-blue-500 rounded-lg p-8 shadow-lg absolute z-10">
        
        <p>Contenuto del rettangolo</p>
    </div>
    
    <img src="{{ url('images/star3d.png')}}" alt="Immagine" class="rounded-full border-4 border-white shadow-lg z-0">
</div>
-->

@endsection
