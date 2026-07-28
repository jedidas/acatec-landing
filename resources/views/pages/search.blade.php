@extends('layouts.app', ['css' => 'search-section'])
@section('title')
    {{ __('Buscar') }}: {{ $search }}
@endsection

@section('preload')
@endsection

@section('banner-section')
    <picture class="block w-full">
        <source srcset="{{ asset('images/banners/top-banner.jpg') }}" media="(min-width: 768px)">
        <img src="{{ asset('images/banners/top-banner2.jpg') }}" alt="Top Banner" class="block w-full">
    </picture>
@endsection

@section('content')
    <section class="bg-gray-100">
        <div class="mx-auto p-4 sm:px-6 lg:container pt-10">
            <x-title icon="search" class="mb-5">{{ __('Buscar') }}: {{ $search }}</x-title>
            <div class="pb-10">
                @if ($products->count())
                    <ul class="gap-5 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                        @foreach ($products as $product)
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
                    <h3 class="text-center text-xl lg:text-2xl font-bold">
                        {{ __('Ningún resultado coincide con tu búsqueda') }}
                    </h3>
                @endif
            </div>
            @if ($products->count())
                <div class="flex pb-5">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @endif
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
