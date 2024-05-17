<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>NeuroClinic | Home Clinico </title>
</head>

<body class="bg-cyan-50">
    <header class="fixed top-0 left-0 right-0 z-20">  
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between p-8">
            <a href="{{ route('home')}}"> 
                <img src="images/logo_bianco.svg" class="h-16" alt="Logo">
            </a>
            <div>
                <nav class="space-x-4 text-white text-sm">
                    <a href="">CARTELLE CLINICHE</a>
                    <a href="{{ route('nuovoPaziente')}}">REGISTRA PAZIENTE</a>
                    <a href="">LOGOUT</a>
                </nav>
            </div>
        </div>
    </header>
   
    <h1 class="text-black font-bold text-5xl mx-8 mt-32">Benvenuto, @yield('utente')</h1>
    <br>
    <div class="p-8 max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <h1 class="text-black text-3xl">Dati anagrafici</h1>
        <br>
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Nome</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">@yield('nomeClin')</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Cognome</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">@yield('cognClin')</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Data di nascita</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">@yield('dataClin')</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Ruolo</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">@yield('ruoloClin')</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Specializzazione</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">@yield('specClin')</p>
        </div>
        <br>
        <br>
        <div class=" flex justify-center items-center">
            <button class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500">
                <a href="{{ route('aggiornaClinico')}}">Aggiorna i tuoi dati</a>
            </button>
        </div>
    </div>
    <hr class="h-1 my-10 bg-cyan-600 m-28">
    <div class="p-8 max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <h1 class="text-black text-3xl">Account</h1>
        <br>
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Username</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">@yield('userClin')</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Password</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2 ">* * * * * * * * * *</p>
        </div>
        <br>
        <div class=" flex justify-center items-center">
            <button class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500 ">Cambia password</button>
        </div>
    </div>
    <hr class="h-1 my-10 bg-cyan-600 m-28">
    <div class=" flex justify-center space-x-20">
        <div class="max-w-[200px] float-left   mb-10 ">
            <button class="bg-cyan-100 border-2 border-cyan-600 shadow-xl rounded-md">
                <a href="{{ route('nuovoPaziente')}}">
                    <img src="{{ url('images/cartella_clinica.png')}}" alt="Cartella clinica">
                </a>
            </button>
            <p class="text-center text-2xl text-black">Cartelle cliniche</p>
        </div>
        <div class="max-w-[200px] float-right mb-10 ">
            <button class="bg-cyan-100 border-2 border-cyan-600 shadow-xl rounded-md">
                <img src="{{ url('images/nuovo_evento.png')}}" alt="Nuovo evento">
            </button>
            <p class="text-center text-2xl text-black">Registra Paziente</p>
        </div>
    </div>
</body>