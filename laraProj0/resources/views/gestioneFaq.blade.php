@extends('layouts.basic')

@section('title', 'Gestione Faq')

@section('content')

<div class="flex justify-center p-4">
    <div class="w-full max-w-lg">
        <div>
            <h1 class="text-5xl font-bold  mt-5 mb-8 gap-y-5 text-center">Gestione FAQ</h1>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md mb-2">
            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion(this)">
                <h2 class="text-base font-semibold">Quali condizioni trattate nella vostra clinica neuroriabilitativa?</h2>
                <span class="text-xl">+</span>
            </div>
            <div class="accordion-content mt-2 hidden">
                <p id="answer-1">Trattiamo una vasta gamma di condizioni neurologiche, tra cui ictus, lesioni cerebrali traumatiche,
                     sclerosi multipla, malattia di Parkinson, neuropatie periferiche, disturbi del movimento e molto altro ancora.
                      Contattateci per discutere delle vostre specifiche esigenze di riabilitazione.</p>
                <button class="bg-blue-500 text-white py-1 px-3 rounded mt-2" onclick="modifica(1)">Modifica</button>
                <button class="bg-red-500 text-white py-1 px-3 rounded mt-2" onclick="elimina(1)">Elimina</button>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mb-2">
            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion(this)">
                <h2 class="text-base font-semibold">Quali tipi di terapie offrite?</h2>
                <span class="text-xl">+</span>
            </div>
            <div class="accordion-content mt-2 hidden">
                <p id="answer-2">Descrizione delle terapie offerte...</p>
                <button class="bg-blue-500 text-white py-1 px-3 rounded mt-2" onclick="modifica(2)">Modifica</button>
                <button class="bg-red-500 text-white py-1 px-3 rounded mt-2" onclick="elimina(2)">Elimina</button>
            </div>
        </div>

    </div>
</div>

<script>
    function toggleAccordion(element) {
    // Ottiene il prossimo elemento fratello dell'elemento cliccato, che è il div successivo
    const content = element.nextElementSibling;
    // Ottiene l'elemento span figlio dell'elemento cliccato
    const span = element.querySelector('span');
    
    // Controlla se il contenuto dell'accordion è nascosto
    if (content.classList.contains('hidden')) {
        // Se è nascosto, rimuove la classe 'hidden' per mostrarlo
        content.classList.remove('hidden');
        // Cambia il testo del span a "-" per indicare che l'accordion è aperto
        span.textContent = "-";
    } else {
        // Se è visibile, aggiunge la classe 'hidden' per nasconderlo
        content.classList.add('hidden');
        // Cambia il testo del span a "+" per indicare che l'accordion è chiuso
        span.textContent = "+";
    }
}

    function modifica(id) {
    }

    function elimina(id) {
    }
</script>

@endsection
