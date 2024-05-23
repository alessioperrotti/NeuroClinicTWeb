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
    <title>NeuroClinic | Home Admin </title>
</head>

<body class="bg-cyan-50">
    <header class="fixed top-0 left-0 right-0 z-20">
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between p-8">
            <a href="{{ route('home')}}">
                <img src="{{ asset('images/logo_bianco.svg')}}" class="h-16" alt="Logo">
            </a>
            <div>
                <nav class="space-x-4 text-white text-sm">
                    <a href="">LOGOUT</a>
                </nav>
            </div>
        </div>
    </header>

    <h1 class="p-10 text-5xl font-bold">Benvenuto, Admin</h1>
    <div class="flex justify-center">
        <div class="m-8 ">
            <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square size-60 ">
                <a href="">
                    <img src="{{ asset('images/question.svg')}}" class="size-60" alt="Clinici">
                </a>
            </div>
            <h2 class="p-2 text-3xl">Gestione clinici</h2>
        </div>
        <div class="m-8 ">
            <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
                <a href="">
                    <img src="{{ asset('images/medicina.svg')}}" class="size-60" alt="Clinici">
                </a>
            </div>
            <h2 class="p-2 text-3xl">Farmaci e attività<br>riabilitative</h2>
        </div>
        <div class="m-8 ">
            <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
                <a href="{{route('analisiDati')}}">
                    <img src="{{ asset('images/grafico.svg')}}" class="size-60" alt="Clinici">
                </a>
            </div>
            <h2 class="p-2 text-3xl">Analisi dati</h2>
        </div>
    </div>


    <div class="flex justify-center">
        <div class="m-8 text-3xl">
            <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
                <a href=>
                    <img src="{{ asset('images/icona_stamp.svg')}}" class="size-60" alt="Clinici">
                </a>
            </div>
            <h2 class="p-2 text-3xl">Gestione disturbi<br>motori</h2>
        </div>
        <div class="m-8 text-3xl">
            <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
                <a href="{{route('listaPaz')}}">
                    <img src="{{ asset('images/elimina_paziente.svg')}}" class="size-60" alt="Clinici">
                </a>
            </div>
            <h2 class="p-2 text-3xl">Elimina pazienti</h2>
        </div>
        <div class="m-8">
            <div class="bg-[#0097B2]/15 border-2 border-black rounded-md aspect-square h-auto w-auto">
                <a href=>
                    <img src="{{ asset('images/dottore.svg')}}" class="size-60" alt="Clinici">
                </a>
            </div>
            <h2 class="p-2 text-3xl">Gestione clinici</h2>
        </div>
    </div>


</body>
