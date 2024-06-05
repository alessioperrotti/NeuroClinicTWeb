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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>NeuroClinic | Home Paziente </title>
</head>

<body class="bg-cyan-50">
    <header class="fixed top-0 left-0 right-0 z-20">
        <div class="bg-cyan-600 h-[100px] flex items-center justify-between p-8">
            <div>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo_bianco.svg') }}" class="h-16" alt="Logo">
                </a>
            </div>
            <div>
                <nav class="space-x-4 text-white text-sm">
                    <a id="openChat" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">SCRIVI AL TUO CLINICO</a>
                    <a href="{{ route('cartellaClinicaPaziente', ['userPaz' => $paziente->username])}}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">CARTELLA CLINICA</a>
                    <a href="{{ route('inserimentoNuovoEvento')}}" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">NUOVO EVENTO</a>
                    @auth
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:bg-cyan-500 p-1 rounded-lg cursor-pointer ">LOGOUT</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <h1 class="text-black font-bold text-5xl mx-8 mt-32">Benvenuto, {{$paziente->nome . " " . $paziente->cognome}}</h1>
    <br>
    <div class="p-8 max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <h1 class="text-black text-3xl">Dati anagrafici</h1>
        <br>
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Nome</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->nome}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Cognome</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->cognome}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Data di nascita</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->dataNasc}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Genere</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->genere}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Indirizzo</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->via . " " . $paziente->civico . " " . $paziente->citta . " " . $paziente->prov}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Telefono</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->telefono}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Indirizzo E-mail</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{$paziente->email}}</p>
        </div>
        <br>
        <br>
        <div class=" flex justify-center items-center">
            <a href="{{ route('aggiornaDatiPaziente', $paziente->username) }}" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500 cursor-pointer">
                Aggiorna i tuoi dati
            </a>
        </div>
    </div>
    <hr class="h-1 my-10 bg-cyan-600 m-28">
    <div class="p-8 max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <h1 class="text-black text-3xl">Account</h1>
        <br>
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Username</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2">{{Auth::user()->username}}</p>
        </div>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <div class="flex">
            <p class="text-black font-bold text-base basis-1/2">Password</p>
            <p class="text-gray-400 font-semibold text-base basis-1/2"> * * * * * * * * * * </p>
        </div>
        <br>
        <div class=" flex justify-center items-center">
            <a href="{{ route('cambiaPwdPaziente')}}" class="p-3 bg-cyan-600 rounded-lg text-white hover:bg-cyan-500 cursor-pointer">Cambia password</a>
        </div>
    </div>
    <hr class="h-1 my-10 bg-cyan-600 m-28">
    <div class="mx-96">
        <div class="max-w-52 float-left   mb-10 ">
            <a href="{{ route('cartellaClinicaPaziente', ['userPaz' => $paziente->username]) }}">
                <img src="{{ asset('images\cartella_clinica.png') }}" alt="Cartella clinica" class="bg-cyan-100 border-2 border-cyan-600 shadow-xl rounded-md cursor-pointer">
            </a>
            <p class="mt-1 text-center text-2xl text-black">Cartella clinica</p>
        </div>
        <div class="max-w-52 float-right mb-10 ">
            <a href="{{ route('inserimentoNuovoEvento')}}">
                <img src="{{ asset('images\nuovo_evento.png') }}" alt="Nuovo evento" class="bg-cyan-100 border-2 border-cyan-600 shadow-xl rounded-md cursor-pointer">
            </a>
            <p class=" mt-1 text-center text-2xl text-black">Nuovo evento</p>
        </div>
    </div>
    <div class="container mx-auto text-center">
        <div class="hidden fixed top-32 right-4 border border-gray-300 rounded-lg shadow-lg bg-white w-96 " id="chatPopup">
            <div class="flex justify-between items-center bg-cyan-600 text-white px-4 py-2 rounded-t-lg">
                <span>Conversazione</span>
                <button type="button" class="close text-white font-bold" id="closeChatBtn">&times;</button>
            </div>
            <div class="p-4 text-left max-h-60 overflow-y-auto" id="messages">
               

            </div>
            <div class="p-4 border-t border-gray-300">
                <textarea id="messageInput" class="w-full p-2 border border-gray-300 rounded mb-2 resize-none" placeholder="Scrivi un messaggio..."></textarea>
                <button id="sendMessageBtn" class="w-full px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500">Invia</button>
            </div>


            <script>
                $(document).ready(function() {


                    //ricevi messaggi
                    function riceviMessaggi() {
                        //ricevi messaggi
                        formElems = {
                            '_token': '{{ csrf_token() }}',
                            'mandante': 'pazipazi',
                            'ricevente': 'clinclin'
                        };

                        $.ajax({
                            url: "{{route('getConversazione')}}",
                            method: 'POST',
                            data: formElems,
                            success: function(response) {
                                console.log("messaggi ricevuti")


                                $('#messages').html(''); //svuota i messaggi

                                // $data.forEach(element => {
                                //     // $('#messages').val('');//svuota i messaggi
                                //     // $('#messages').append('<div class="message mb-2"><strong>' + element.mandante + ':</strong> ' + element.contenuto + '</div>');
                                // });
                                console.log(response);

                                for (var key in response) {
                                    var messaggio = response[key];
                                    //voglio solo vedere l'ora e i minuti
                                    var data = new Date(messaggio.updated_at);

                                    console.log(data);

                                    // Ottieni giorno, mese, ora e minuti
                                    var day = data.getDate().toString().padStart(2, '0');
                                    var month = (data.getMonth() + 1).toString().padStart(2, '0'); // I mesi sono indicizzati da 0
                                    var hours = data.getHours().toString().padStart(2, '0');
                                    var minutes = data.getMinutes().toString().padStart(2, '0');


                                    var datames = day + '/' + month + ' ' + hours + ':' + minutes;



                                    //da_aggiungere = '<div><strong>' +messaggio.mandante+':</strong> '+'<div class="flex justify-between"><div>'+messaggio.contenuto+'<div class="relative"><h1 class="text-slate-500 text-xs absolute bottom-0 right-0">'+ora+ '</h1></div></div>';           


                                    da_aggiungere = '<div class="mb-2"><strong>' + messaggio.mandante + '</strong><div class="flex justify-between"><div>' + messaggio.contenuto + '</div><div class="relative"><h1 class="text-slate-500 text-xs absolute bottom-0 right-0">' + datames + '</h1></div></div></div>';


                                    $('#messages').append(da_aggiungere);
                                }
                            }
                        });
                    }



                    riceviMessaggi();
                    setInterval(riceviMessaggi, 5000); //ogni 5 secondi ricevi i messaggi


                    $('#closeChatBtn').click(function() {
                        $('#chatPopup').hide();
                    });

                    $('#openChat').click(function() {
                        $('#chatPopup').show();
                    });


                    // Invia messaggio
                    $('#sendMessageBtn').on('click', function() {
                        var message = $('#messageInput').val();

                        $('#messageInput').val('');

                        if (message.trim() !== '') {

                            formElems = {
                                '_token': '{{ csrf_token() }}',
                                'contenuto': message,
                                'mandante': 'pazipazi',
                                'ricevente': 'clinclin'
                            };

                            // Invia il messaggio al server
                            $.ajax({
                                url: "{{route('sendMessaggio')}}",
                                method: 'POST',
                                data: formElems,
                                success: function(data) {
                                    console.log("messaggio inviatooo")
                                }
                            });

                           

                            setTimeout(riceviMessaggi, 500);


                        }



                    });





                });
            </script>
</body>