<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>NeuroClinic | Home </title>
</head>
<body class="bg-cyan-50">
    <header>
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between">
            <div> 
                <img src="images/logo_bianco.svg" class="h-16" alt="Logo">  <!-- qui va aggiunto l'href alla homepage -->
            </div>
            <div>
                <nav class="space-x-4 text-white text-sm">
                    <a href="">CHI SIAMO</a>
                    <a href="">FAQ</a>
                    <a href="">CONTATTACI</a>
                    <a href="{{ route('login') }}">AREA RISERVATA</a>
                </nav>
            </div>
        </div>
    </header>
    
</body>
</html>