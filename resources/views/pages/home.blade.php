@extends('layouts.seo', ['css' => 'home-section ' . $sectionName])

@section('title')
    {{ __('Inicio') }}
@endsection

@section('banner')
    @include('partials.top-banner')
@endsection

@section('content')
    <section class="bg-gray-100 p-4">
        <div class="container m-auto mb-6 py-5">
            <x-title icon="youtube">Home</x-title>
        </div>
        <div class="home_page">
            <div class="mx-auto container">
                <x-title icon="youtube">{{ __('Novedades') }}</x-title>
                <div class="pb-10">

                </div>
            </div>

    </section>
@endsection

@section('bottom-section')
    <section class="bg-app-lighter-silver p-4 pt-14 pb-24">
        <div class="mx-auto container">
            <x-title icon="youtube">{{ __('Destacados') }}</x-title>

        </div>
    </section>
@endsection
