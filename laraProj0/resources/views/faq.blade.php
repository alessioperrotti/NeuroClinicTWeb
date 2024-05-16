@extends('layouts.basic')

@section('title', 'FAQ')

@section('content')
<div class="flex flex-row flex-nowrap">
    <div name="textring" class="basis-1/3 items-center mt-10">
        <div class="font-bold text-5xl absolute z-10 pl-16 pt-36 text-gray-800">
            <p class="mb-4">Frequently</p>
            <p class="mb-4">Asked</p>
            <p>Questions</p>
        </div>
        <img src="{{ url('images/anello.png')}}" class="z-0 h-[500px] pt-5" >
    </div>
    <div name="q&a" class="basis-2/3">
        <!-- prototipo card q&a -->
        <!-- foreach {echo } -->
        <div name="card q&a" class="bg-white shadow-inner rounded-2xl h-24 my-3 pr-8">

        </div>
    </div>
</div>
@endsection
