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
        <title>NeuroClinic | Home Paziente </title>
</head>

<body class="bg-cyan-50">
    <header class="fixed top-0 left-0 right-0 z-20">  
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between p-8">
            <div>
                <a href="{{ route('home') }}"> 
                    <img src="images/logo_bianco.svg" class="h-16" alt="Logo">
                </a>    
            </div>
            <div>
                <nav class="space-x-4 text-white text-sm">
                    <a href="">CARTELLA CLINICA</a>
                    <a href="">NUOVO EVENTO</a>
                </nav>
            </div>
        </div>
    </header>
   
    <h1 class="text-black font-bold text-5xl mx-8 mt-32">Benvenuto, Mario Rossi</h1>
    <br>
    <div class="p-8 max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <h1 class="text-black text-3xl">Dati anagrafici</h1>
        <br>
        <p class="text-black font-bold text-base">Nome</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Cognome</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Data di nascita</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Genere</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Indirizzo</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Telefono</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Indirizzo e-mail</p>
        <br>
        <br>
        <div class=" flex justify-center items-center">
            <button class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500 ">
                Aggiorna i tuoi dati
            </button>
        </div>
    </div>
    <hr class="h-1 my-10 bg-cyan-600 m-28">
    <div class="p-8 max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <h1 class="text-black text-3xl">Account</h1>
        <br>
        <p class="text-black font-bold text-base">Username</p>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <p class="text-black font-bold text-base">Password</p>
        <br>
        <div class=" flex justify-center items-center">
            <button class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500 ">Cambia password</button>
        </div>
    </div>
    <hr class="h-1 my-10 bg-cyan-600 m-28">
    <div class="mx-96">
        <div class="max-w-52 float-left   mb-10 ">
            <button class="bg-cyan-100 border-2 border-cyan-600 shadow-xl rounded-md">
                <img src="{{ url('images\cartella_clinica.png') }}" alt="Cartella clinica">
            </button>
            <p class="mt-1 text-center text-2xl text-black">Cartella clinica</p>
        </div>
        <div class="max-w-52 float-right mb-10 ">
            <button class="bg-cyan-100 border-2 border-cyan-600 shadow-xl rounded-md">
                <img src="{{ url('images\nuovo_evento.png') }}" alt="Nuovo evento">
            </button>
            <p class=" mt-1 text-center text-2xl text-black">Nuovo evento</p>
        </div>
    </div>
</body>