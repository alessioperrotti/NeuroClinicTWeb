<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>NeuroClinic | @yield('title') </title>
</head>
<body class="bg-cyan-50">
    <header>
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between">
            <div>
                <img src="images/logo_bianco.svg" class="h-16" alt="Logo">  <!-- qui va aggiunto l'href alla homepage -->
            </div>
        </div>
    </header>
    <div>
        @yield('content')
    </div>
</body>
</html>