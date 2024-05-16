@extends('layouts.basic')

@section('title', 'Login')

@section('content')
<div class="flex place-content-center justify-center">
    <div class="bg-white rounded-xl h-[480px] w-[400px] absolute z-10 p-8 mt-[100px] items-center">
        <h1 class="font-bold font-sans text-3xl text-center mb-12">Accedi</h1>
        <form class="flex flex-col items-center">  
            <div class="mb-8">
                <label for="user" class="text-xl font-semibold">Username</label>
                <br>
                <input id="user" type="text" class="border rounded-md h-[60px] w-[336px] p-4 text-xl">
            </div>
            <div class="mb-8"> 
                <label for="user" class="text-xl font-semibold">Password</label>
                <br>
                <input id="user" type="password" class="border rounded-md h-[60px] w-[336px] p-4 text-xl">
            </div>
            <input type="submit" class="bg-cyan-600 rounded-xl mt-3 w-[200px] h-[60px] text-white font-semibold" value="Login">   
        </form>
    </div>
    <img src="{{ url('images/star3d.png')}}" class="h-[700px] z-0" alt="Sfondo Login">
</div>
@endsection
