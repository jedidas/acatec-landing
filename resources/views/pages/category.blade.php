@extends('layouts.seo', ['css' => 'category-section ' . $sectionName])

@section('title')
    {{ $data->name }}
@endsection

@section('preload')
@endsection

@section('banner')
    <picture class="block w-full top-small-banner">
        @if ($data->image)
            <img src="{{ asset('storage/' . $data->image) }}" alt="Top Banner" class="block w-full">
        @else
            <source srcset="{{ asset('images/banners/top-banner.jpg') }}" media="(min-width: 768px)">
            <img src="{{ asset('images/banners/top-banner2.jpg') }}" alt="Top Banner" class="block w-full">
        @endif
    </picture>
@endsection


@section('content')
    <div class="mx-auto p-4 sm:px-6 lg:container pt-10">
        <div class="flex justify-between">
            <x-title>{{ $data->name }}</x-title>
            <div class="filter">
                <form method="post" id="order_widget">
                    <select name="order_by">
                        <option value="" @selected(empty($orderBy))>Relevancia</option>
                        <option value="high_price" @selected($orderBy === 'high_price')>
                            Precio: mayor a menor
                        </option>
                        <option value="low_price" @selected($orderBy === 'low_price')>
                            Precio: menor a mayor
                        </option>
                        <option value="ascending_name" @selected($orderBy === 'ascending_name')>
                            Nombre: A → Z
                        </option>
                        <option value="descending_name" @selected($orderBy === 'descending_name')>
                            Nombre: Z → A
                        </option>
                    </select>
                </form>
            </div>
        </div>
        <article class="py-5 mb-20">
            @include('partials.products-by-category', ['products' => $products])
        </article>
    </div>
@endsection

@section('bottom-section')
    <section class="featured-section bg-amber-50 pb-10">
        <div class="mx-auto p-4 sm:px-6 lg:container">
            <x-title class="white">{{ __('Destacados') }}</x-title>
            @include('partials.featured-slider-products')
        </div>
    </section>
@endsection
