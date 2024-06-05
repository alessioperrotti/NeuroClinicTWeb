<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- vite('resources/css/app.css') -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>NeuroClinic | Home </title>
    <style>
        .anchor::before {
            content: "";
            display: block;
            height: 140px;
            margin-top: -140px; /* Altezza dell'header */
            visibility: hidden;
        }
    </style>
</head>
<body class="bg-cyan-50">
    <header class="fixed top-0 left-0 right-0 z-20">  <!-- sarebbe carino mettere un backdrop blur-->
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between p-8 backdrop-filter backdrop-blur-sm bg-opacity-90">
            <div>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo_bianco.svg')}}" class="h-16" alt="Logo">
                </a>
            </div>
            <div>
                <nav class="space-x-4 text-white text-sm">

                    <a href="#who" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">CHI SIAMO</a>
                    <a href="{{ route('faq') }}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">FAQ</a>
                    <a href="#contact" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">CONTATTACI</a>
                    @guest
                        <a href="{{ route('login') }}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">LOGIN</a>
                    @endguest
                    @can('isPaziente')
                        <a href="{{ route('homePaziente') }}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">AREA RISERVATA</a>
                    @endcan
                    @can('isClinico')
                        <a href="{{ route('homeClinico') }}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">AREA RISERVATA</a>
                    @endcan
                    @can('isAdmin')
                        <a href="{{ route('homeAdmin') }}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">AREA RISERVATA</a>
                    @endcan

                </nav>
            </div>
        </div>
    </header>
    <div class="relative">
            
        <div class="slides relative w-full overflow-hidden">
            <!-- IMMAGINI CAROSELLO -->
            <img src="{{ asset('images/banner1.gif')}}" alt="Banner 1" class="w-full">
            <img src="{{ asset('images/banner2.gif')}}" alt="Banner 2" class="w-full hidden">
            <img src="{{ asset('images/banner3.gif')}}" alt="Banner 3" class="w-full hidden">
        </div>
        <div class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center z-10">
            <h1 class="font-bold text-6xl text-white">Ogni passo è una vittoria</h1>
        </div>
    </div>
    <div class="h-[40px]"></div>
    <div class="bg-white m-6 h-auto rounded-xl flex shadow-md">
        <div class="p-8">
            <h1 id="who" class="text-black font-extrabold text-2xl anchor">Chi siamo</h1>
            <br>
            <p class="text-slate-700">Siamo una clinica neuroriabilitativa dedicata al miglioramento
                della qualità della vita dei nostri pazienti attraverso terapie innovative e personalizzate.
                Con un team multidisciplinare di professionisti altamente qualificati, ci impegniamo a fornire
                un approccio completo e compassato alla riabilitazione neurologica.
            </p>
            <br>
            <p class="text-slate-700">La nostra missione è quella di essere un faro di speranza e di sostegno
                per coloro che affrontano sfide neurologiche quali ictus, lesioni cerebrali traumatiche, sclerosi
                multipla, malattia di Parkinson, e altre condizioni complesse. Ogni paziente è un
                individuo unico, e ci sforziamo di offrire un trattamento personalizzato che tenga conto delle
                loro esigenze specifiche e dei loro obiettivi di riabilitazione.
            </p>
        </div>
        <div class="overflow-hidden rounded-xl">
            <img src="images/gruppo_medici.gif" alt="Gruppo di medici">
        </div>
    </div>
    <div class="h-[22px]"></div>
    <div class="bg-white m-6 h-auto rounded-xl flex shadow-md">
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
    <div class="flex justify-center">
        <hr class="h-[3px] rounded bg-cyan-500 mb-2 w-[70%]">
    </div>
    <div class="flex justify-between px-20 py-4">
        <div class="items-center w-[300px] justify-center">
            <div class="rounded-xl bg-white items-center shadow-md p-8">
                <h3 class="font-bold text-center text-3xl text-slate-700">"Eccellente"</h3>
                <br>
                <p class="text-center text-slate-400">Un servizio di altissima qualità e grande professionalità.
                    Gli specialisti di NeuroClinic ci hanno permesso di ottenere risultati
                    in cui neanche noi speravamo più.
                </p>
            </div>
        </div>
        <div class="flex items-center w-[300px] justify-center">
            <div class="rounded-xl bg-white items-center shadow-md p-8">
                <h3 class="font-bold text-center text-3xl text-slate-700">"Una garanzia"</h3>
                <br>
                <p class="text-center text-slate-400">Io e la mia famiglia ci rivolgiamo a Neuro Clinic
                    da anni ormai, date le tante esperienze positive.
                </p>
            </div>
        </div>
        <div class="flex items-center w-[300px] justify-center">
            <div class="rounded-xl bg-white items-center shadow-md p-8">
                <h3 class="font-bold text-center text-3xl text-slate-700">"Soddisfatto"</h3>
                <br>
                <p class="text-center text-slate-400">Lo staff di Neuro Clinic è composto da ottime persone
                    oltre che da grandi professionisti. Mi sono sentito a casa!
                </p>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <hr class="h-[3px] rounded bg-cyan-500 mb-4 mt-2 w-[70%]">
    </div>
    <h1 id="contact" class="text-center font-bold text-4xl text-slate-700 anchor">Contattaci</h1>

    <div class="flex justify-center">
        <div class="bg-white rounded-xl m-6 h-96 w-[900px] flex justify-between shadow-md">
            <div class="bg-cyan-600 p-8 rounded-xl shadow-md z-20">
                <br>
                <h4 class="font-bold text-white">Come Contattarci</h4>
                <ul style="list-style-type: circle">
                    <li><p class="text-white">Via e-mail scrivendo a<br><a href="mailto:info@neuroclinic.it">info@neuroclinic.it</a></p>
                    <li><p class="text-white">Per telefono chiamando il<br><a href="tel:0713230">071-3230</a></p>
                </ul>
                </p>
                <br>
                <h4 class="font-bold text-white">Dove Siamo</h4>
                <ul style="list-style-type: circle">
                    <li><p class="text-white">Piazza Enrico Malatesta 1<br>60121, Ancona(AN)</p>
                </ul>
            </div>
            <div>
                <iframe class="rounded-xl z-10" width="650px" height="384px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d474.75925022760055!2d13.515433449069254!3d43.619141431873956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132d7fb952605377%3A0x440757e90c2d2cba!2sPiazza%20Enrico%20Malatesta%2C%201%2C%2060121%20Ancona%20AN!5e0!3m2!1sit!2sit!4v1715613705541!5m2!1sit!2sit" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <footer>
        <div class="bg-cyan-600 w-auto h-[200px] justify-between items-center flex p-8">
            <div>
                <a href="{{ route('home') }}">
                    <img src="images/logo_bianco.svg" class="h-20" alt="Logo">
                </a>
            </div>
            <div>
                <h4 class="font-bold text-white text-xl mr-8">Informazioni di Contatto</h4>
                <br>
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/location_pin.png')}}" class="h-4">
                    <p class="font-sans text-white">Piazza Enrico Malatesta, 1 60121 Ancona (AN)</p>
                </div>
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/phone.png')}}" class="h-4">
                    <p class="font-sans text-white">Tel <a href="tel:3549783214">+39 354 978 3214</a></p>
                </div>
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/email.png')}}" class="h-4">
                    <p class="font-sans text-white">Email <a href="mailto:info@neuroclinic.it">info@neuroclinic.it</a></p>
                </div>
            </div>
        </div>
    </footer>


</body>

<script>
    $(document).ready(function () {
        // indice slide corrente 
        let i = 0;
        // Seleziona tutti gli elementi img all'interno del contenitore con la classe 'slides'
        const $slides = $(".slides img");

        // Seleziona tutti gli elementi con la classe 'dot'
        const $dots = $(".dot");

        // Funzione per mostrare la slide corrispondente all'indice passato
        function showSlide(index) {
            // Per ogni slide, aggiungi o rimuovi la classe 'hidden' in base all'indice
            $slides.each(function (i) {
                $(this).toggleClass("hidden", i !== index);
            });
            
            // Per ogni puntino di navigazione, aggiorna le classi per indicare la slide corrente
            $dots.each(function (i) {
                $(this).toggleClass("bg-white", i === index); // Imposta il puntino corrente come bianco
                $(this).toggleClass("bg-gray-400", i !== index); // Imposta gli altri puntini come grigi
            });
        }
        // Funzione per passare alla slide successiva
        function nextSlide() {
            // Incrementa l'indice della slide corrente e calcola il modulo per tornare a 0 se supera il numero di slide
            i = (i + 1) % $slides.length;
            // Mostra la slide corrispondente al nuovo indice
            showSlide(i);
        }
        // Mostra la prima slide inizialmente
        showSlide(i);
        // Imposta un intervallo per cambiare automaticamente slide ogni 3 secondi
        setInterval(nextSlide, 3000);
    });
</script>
</html>
