@extends('layouts.basic')

@section('title')
Analisi Dati
@endsection


@section('content')
<div class='m-4 px-10'>
    <div class='flex justify-center'>
        <h1 class='text-5xl font-bold mx-5 mb-8'>Analisi dei dati</h1>
    </div>

    <div class="flex space-x-10">
        <div class='bg-white text-lg w-1/2 py-2 px-5 border rounded border-gray-300 h-80 overflow-y-auto'>
            <div class='flex justify-between px-5 gap-x-4 py-4'>
                <h2 class='w-1/3 font-semibold'>Media pazienti per clinico</h2>
                @isset($mediaPazientiPerClinico)
                <h2>{{$mediaPazientiPerClinico}}</h2>
                @endisset
            </div>
            <hr class="mb-8">
            <div class='flex justify-between px-5 gap-x-4 py-4'>
                <h2 class='w-1/3 font-semibold'>Disturbo motorio</h2>
                <select id="disturboSelect">
                    <option value="" disabled selected>Seleziona un disturbo</option>
                    @isset($disturbiMotori)
                        @foreach($disturbiMotori as $disturbo)
                            @if($disturbo)
                            <option value="{{ $disturbo->id }}">{{ $disturbo->nome }}</option>
                            @endif
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class='flex justify-between px-5 gap-x-4 py-4 items-center'>
                <h2 class='w-1/3 font-semibold'>Numero di eventi totali registrati:</h2>
                <h2 id="numEpisodi"></h2>
            </div>
        </div>

        <div class="w-1/2 border border-gray-300 rounded flex flex-col h-80">
            <input class="w-full p-2 border-b border-gray-300 rounded-t focus:outline-none focus:border-b-2 focus:border-blue-500" 
            type="text" id="cognomePaziente" placeholder="Cerca per cognome">
            
            <div class="bg-white overflow-y-auto flex-grow table-container ">
                <table class="min-w-full bg-white">
                    <thead >
                        <tr class="sticky top-0 bg-white">
                            <th class="px-4 py-2 font-semibold uppercase tracking-wider">Paziente</th>
                            <th class="px-4 py-2 font-semibold uppercase tracking-wider">Numero cambi terapia</th>
                            <th class="px-4 py-2 font-semibold uppercase tracking-wider">Media di eventi di disturbi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($pazienti)
                        @foreach($pazienti as $paziente)
                            @if($paziente)
                            <tr class="paziente">
                                <td class="px-4 py-2"> {{ $paziente->nome }} {{ $paziente->cognome }}</td>
                                <td class="px-4 py-2">{{ $paziente->numeroCambiTerapia }}</td>
                                <td class="px-4 py-2">{{ $paziente->mediaEventiDiDisturbi }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Filtro per cognome
        document.getElementById('cognomePaziente').addEventListener('input', function() {
            var filter = this.value.toLowerCase();
            document.querySelectorAll('.paziente').forEach(function(row) {
                var fullName = row.querySelector('td:first-child').textContent.toLowerCase();
                var cognome = fullName.split(' ').pop();
                row.style.display = cognome.startsWith(filter) ? '' : 'none';
            });
        });

        // Gestore di eventi per la selezione del disturbo
        document.getElementById('disturboSelect').addEventListener('change', function() {
            var disturboId = this.value;
            fetch("{{ route('episodi.disturbo', ':id') }}".replace(':id', disturboId))
                .then(response => response.json()) // Se il fetch è andato a buon fine, trasformo la risposta in formato JSON
                .then(data => {                    // Data è una funzione di callback che prende i dati JSON ottenuti dalla risposta della richiesta.
                    document.getElementById('numEpisodi').textContent = data.numeroEpisodi;
                })
                .catch(error => console.error('Errore:', error));
        });
    });
</script>

@endsection

