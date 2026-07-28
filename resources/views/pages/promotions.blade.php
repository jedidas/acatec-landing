@extends('layouts.seo', ['css' => 'promotion-section'])

@section('title')
    {{ $data->name }}
@endsection

@section('banner')
    <picture class="block w-full top-small-banner">
        @if ($data->image)
            <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" class="block w-full">
        @else
            <source srcset="{{ asset('images/banners/top-banner.jpg') }}" media="(min-width: 768px)">
            <img src="{{ asset('images/banners/top-banner2.jpg') }}" alt="{{ $data->name }}" class="block w-full">
        @endif
    </picture>
@endsection

@section('preload')
@endsection

@section('content')
    <section class="bg-gray-100 p-4">
        <div class="container m-auto mb-6 py-5">
            <x-title icon="youtube">{{ $data->name }}</x-title>
        </div>
        <div class="promotions_page">
            <div class="mx-auto p-4 sm:px-6 lg:container">
                {!! $data->content !!}
                </article>
            </div>
        </div>
    </section>
@endsection

@section('bottom-section')
    <section class="featured-section bg-amber-50 pt-10 pb-10 px-5">
        <div class="mx-auto p-4 sm:px-6 lg:container">
            <x-title>{{ __('Productos relacionados') }}</x-title>
            @include('partials.related-products', ['products' => $products])
        </div>
    </section>
@endsection
