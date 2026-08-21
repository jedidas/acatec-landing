@extends('layouts.seo', ['css' => 'home-section ' . $sectionName])

@section('title')
    {{ __('Inicio') }}
@endsection

@section('banner')
    @include('partials.top-banner')
@endsection

@section('content')
    @include('pages._capacitaciones')
    <div class="visual-break items-center flex justify-center p-5 md:py-10 blue-visual-break">
        <div class="bg-secondary-600/60 flex justify-center items-center rounded-full shadow aspect-square w-40">
            <x-icon name="green-visual-break" class="h-30 w-30" />
        </div>
    </div>
    @include('pages._outsourcing')
    @include('pages._planes')
    <div class="visual-break items-center flex justify-center p-10 md:py-20 green-visual-break">
        <div class="bg-success-600/60 flex justify-center items-center rounded-full shadow aspect-square w-40">
            <x-icon name="green-visual-break" class="h-30 w-30" />
        </div>
    </div>
    @include('pages._bandera')
    @include('pages._servicios')
@endsection

@section('bottom-section')
@endsection
