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
                    @if ($productsFromEachCategory->count())
                        <ul class="gap-5 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                            @foreach ($productsFromEachCategory as $product)
                                <li>
                                    @php
                                        [$categoryName] = explode('/', $product->category->slug);
                                    @endphp
                                    @include('partials.product-item', [
                                        'categoryName' => $categoryName,
                                        'product' => $product,
                                        'showCategory' => true,
                                    ])
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h3 class="p-4 text-center text-2xl font-bold">{{ __('Sin productos disponibles') }}</h3>
                    @endif
                </div>
            </div>

    </section>
@endsection

@section('bottom-section')
    <section class="bg-app-lighter-silver p-4 pt-14 pb-24">
        <div class="mx-auto container">
            <x-title icon="youtube">{{ __('Destacados') }}</x-title>
            @include('partials.featured-products')
        </div>
    </section>
@endsection
