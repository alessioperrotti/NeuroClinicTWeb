<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- vite('resources/css/app.css') -->
    <title>NeuroClinic | @yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cyan-50">
    <header>
        <div class="bg-cyan-600 h-[100px] flex items-center justify-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo_bianco.svg') }}" class="h-16" alt="Logo">  <!-- qui va aggiunto l'href alla homepage -->
            </a>
        </div>
    </header>
    <div class="text-gray-600">
        <button id="back_button" onclick="window.history.back()" class="btn btn-secondary p-2">
            <i class="fas fa-arrow-left "></i> Indietro
        </button>
    </div>
    <div name="content">
        @yield('content')
    </div>
</body>
</html>