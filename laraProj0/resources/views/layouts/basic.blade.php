<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- vite('resources/css/app.css') -->
    <title>NeuroClinic | @yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @show
    @yield('scripts')
    <script>

        function togglePassword(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);
              
            if (input.type === 'password') {
                input.type = 'text';
                eye.src ="{{asset('images/eye-slash-solid.png')}}";
                eye.alt = 'Hide password';
            } else {
                input.type = 'password';
                eye.src = "{{asset('images/eye-solid.png')}}";
                eye.alt = 'Show password';
            }
        }
   
    </script>
    @show
    
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
        <button id="back_button" onclick="window.location.href = document.referrer"
                                 class="btn btn-secondary p-2">

            <p class="fas fa-arrow-left "></p> Indietro

        </button>
    </div>
    <div name="content">
        @yield('content')
    </div>
</body>
</html>