<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>NeuroClinic | @yield('title') </title>
</head>
<body class="bg-cyan-50">
    <header class="h-[100px]">
        <div class="bg-cyan-600">
            <img src="images/logo_bianco.svg" class="object-center h-10" alt="Logo">
        </div>
    </header>
</body>
</html>