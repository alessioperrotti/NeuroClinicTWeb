@extends('layouts.basic')

@section('title', 'Modifica Diagnosi')

@section('content')
@isset($paziente)
<h1 class="text-5xl font-bold ml-5 mt-5 mb-8">Modifica diagnosi di {{ $paziente->nome . " " . $paziente->cognome }}</h1>
@endisset
<div class="flex flex-col items-center mb-8">
    <div class="bg-white mx-16 mb-6 rounded-xl shadow-md h-auto p-8 max-w-[800px]">
        <h3 class="text-2xl font-semibold">Disturbi diagnosticati</h3>
        <hr class="h-0.5 my-2 bg-cyan-600">
        <form method="POST" action="{{ route('modificaDiagnosi.store', $paziente->username)}}">
        @csrf
        <ul style="list-style-type: disc" class="ml-6 mt-6 flex flex-wrap">
            @isset($disturbi)
                @foreach($disturbi as $disturbo)
                @if($disturbo)
                <li class="mb-4 w-1/2">
                    <div class="space-x-4">
                        <label class="text-base font-semibold text-gray-800">{{ $disturbo->nome}}</label>
                        <input id={{$disturbo->id}} type="checkbox" name="disturbo[]" value="{{ $disturbo->id}}">
                    </div>
                    <p class="my-2 text-gray-600 text-sm">Categoria: {{$disturbo->categoria}}</p>
                </li>
                @endif
                @endforeach
            @endisset
        </ul>
        <div class="flex flex-row justify-center my-8 space-x-16">
            <input type="button" value="Annulla Modifiche" onclick="location.reload();" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 w-[180px] cursor-pointer">
            <input type="submit" value="Conferma Modifiche" class="bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-500 w-[180px] cursor-pointer">
        </div>
        </form>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {

        var distDiagnosi = @json($distDiagnosi);

        // per ogni disturbo già diagnosticato, imposto la checkbox come checked
        distDiagnosi.forEach(function(dist) {
            $('input[type="checkbox"][value= "' + dist.id + '"]').prop('checked', true);
        })

    })
</script>
@endsection