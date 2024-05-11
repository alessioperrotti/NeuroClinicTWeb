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
    <header class="fixed top-0 left-0 right-0 z-20">  <!-- sarebbe carino mettere un backdrop blur-->
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between p-8">
            <div> 
                <img src="images/logo_bianco.svg" class="h-16" alt="Logo">
            </div>
            <div>
                <nav class="space-x-4 text-white text-sm">
                    <a href="#who">CHI SIAMO</a>
                    <a href="">FAQ</a>
                    <a href="">CONTATTACI</a>
                    <a href="{{ route('login') }}">AREA RISERVATA</a>
                </nav>
            </div>
        </div>
    </header>
    <div class="relative">
        <img src="images/banner2.gif" alt="Banner Homepage">
        <div class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center z-10">
            <h1 class="font-bold text-6xl text-white">Ogni passo è una vittoria</h1>
        </div>
    </div>
    <div class="h-[40px]"></div>
    <div class="bg-white m-6 h-auto rounded-xl flex">
        <div class="p-8">
            <h1 id="who" class="text-black font-extrabold text-2xl">Chi siamo</h1>
            <br>
            <p class="text-slate-700">Siamo una clinica neuroriabilitativa dedicata al miglioramento 
                della qualità della vita dei nostri pazienti attraverso terapie innovative e personalizzate. 
                Con un team multidisciplinare di professionisti altamente qualificati, ci impegniamo a fornire 
                un approccio completo e compassato alla riabilitazione neurologica.
            </p>
            <br>
            <p class="text-slate-700">La nostra missione è quella di essere un faro di speranza e di sostegno 
                per coloro che affrontano sfide neurologiche, quali ictus, lesioni cerebrali traumatiche, sclerosi 
                multipla, malattia di Parkinson, e altre condizioni neurologiche complesse. Ogni paziente è un 
                individuo unico, e ci sforziamo di offrire un trattamento personalizzato che tenga conto delle 
                loro esigenze specifiche e dei loro obiettivi di riabilitazione.
            </p>
        </div>
        <div class="overflow-hidden rounded-xl">
            <img src="images/gruppo_medici.gif" alt="Gruppo di medici">
        </div>
    </div>
    <div class="h-[22px]"></div>
    <div class="bg-white m-6 h-auto rounded-xl flex">
        <div class="overflow-hidden rounded-xl">
            <img src="images/schermo.gif" alt="Gruppo di medici">
        </div>
        <div class="p-8">
            <p class="text-slate-700">Presso Neuro Clinic, integriamo le più recenti scoperte scientifiche 
                con le migliori pratiche cliniche per offrire una gamma completa di servizi di riabilitazione, 
                tra cui terapia occupazionale, terapia fisica, terapia del linguaggio e terapia cognitiva. 
                Utilizziamo anche tecnologie all'avanguardia, come la robotica e la realtà virtuale, per 
                ottimizzare i risultati della riabilitazione.
            </p>
            <br>
            <p class="text-slate-700">La nostra visione è quella di essere un punto di riferimento 
                nell'ambito della riabilitazione neurologica, dove l'innovazione, la compassione e l'empatia 
                si fondono per creare un ambiente di cura e di crescita per tutti coloro che serviamo.
            </p>
        </div>
    </div>

    
</body>
</html>