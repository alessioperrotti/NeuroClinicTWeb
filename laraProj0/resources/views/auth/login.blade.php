@extends('layouts.basic')

@section('title', 'Login')

@section('content')
<div class="flex place-content-center justify-center">
    <div class="bg-white rounded-xl min-h-[480px] w-[400px] absolute z-10 p-8 mt-[100px] items-center">
        <h1 class="font-bold font-sans text-3xl text-center mb-12">Accedi</h1>
        <form class="flex flex-col items-center" method="POST" action="{{ route('login')}}"> 
            @csrf 
            <div class="mb-8">
                <label for="user" class="text-xl font-semibold">Username</label>
                <br>
                <input name="username" id="user" type="text" class="border rounded-md h-[60px] w-[336px] p-4 text-xl">
                @if ($errors->first('username'))
                    <div class="alert alert-danger text-red-500">
                        <ul>
                            @foreach ($errors->get('username') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="mb-8"> 
                <label for="password" class="text-xl font-semibold">Password</label>
                <br>
                <div class="relative">
                    <input name="password" id="password" type="password" class="border rounded-md h-[60px] w-[336px] p-4 text-xl">
                    <button id="pulsante"type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-700" onclick="togglePassword('password', 'eyeId1')">
                        <img id="eyeId1" src="{{asset('images/eye-solid.png')}}" alt="toggle" class="w-5">
                    </button>
                </div>
                @if ($errors->first('password'))
                    <div class="alert alert-danger text-red-500">
                        <ul>
                            @foreach ($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <input type="submit" class="bg-cyan-600 rounded-xl mt-3 w-[200px] h-[60px] text-white font-semibold hover:bg-cyan-500 cursor-pointer" value="Login">   
        </form>
    </div>
    <img src="{{ asset('images/star3d.png')}}" class="h-[700px] z-0" alt="Sfondo Login">
</div>

<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {
        elem_id = "back_button";
        rotta = "{{ route('home') }}";
        sovrascriviOnClick(elem_id,rotta);
    });
</script>
@endsection


