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
        <div class="bg-secondary-500/70">
            <div class="border-white border-10 lg:py-3 p-4 pl-6 lg:p-8 pr-3.5 relative box-info">
                <span
                    class="inline-block p-1.5 px-1.5 rounded-full bg-white/40 leading-3 text-2xs md:text-xs text-secondary-650 mb-0.5 md:mb-2">
                    Su equipo crece con el respaldo de nuestros especialistas.
                </span>
                <p class="text-white font-light text-sm lg:text-3xl">Seguridad a través del aprendizaje</p>
            </div>
        </div>
    </div>
    @include('pages._outsourcing')
    @include('pages._planes')
    <div class="visual-break items-center flex flex-col gap-2 justify-center p-10 md:py-20 green-visual-break">
        <div class="bg-success-600/60 flex justify-center items-center rounded-full shadow aspect-square w-40">
            <x-icon name="green-visual-break" class="h-30 w-30" />
        </div>
        <p class="bg-success-600/60 text-white p-3 py-1 rounded-full text-center">Acciones para un futuro mejor</p>
    </div>
    @include('pages._bandera')
    @include('pages._servicios')
@endsection

@section('bottom-section')
@endsection
