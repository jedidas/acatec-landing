@extends('layouts.seo', ['css' => 'product-detail  product-detail-section ' . $sectionName, 'productDetailImage' => $data->image])

@section('title')
    {{ $data->name }}
@endsection

@section('css')
    @vite(['resources/sass/detail.scss', 'resources/ts/detail.ts'])
@endsection

@section('preload')
@endsection

@section('banner')
@endsection

@section('content')
    <section class="mx-auto p-4 sm:px-6 lg:container pt-10">
        <div class="flex flex-col xl:flex-row mb-5">
            <div class="w-full xl:w-1/2">
                <div class="mb-3 swiper gallery">
                    @if ($data->is_featured)
                        <span class="featured">Oportunidad</span>
                    @endif
                    <div class="swiper-wrapper h-auto!">
                        <picture class="block swiper-slide default-loading">
                            <img data-src="{{ asset('storage/' . $data->image) }}"
                                src="{{ asset('images/products/empty-default.png') }}" alt="{{ $data->name }}"
                                class="lazy aspect-4/3 w-full">
                        </picture>
                        @foreach ($images as $image)
                            <picture class="block swiper-slide">
                                <img data-src="{{ asset('storage/' . $image->image) }}" alt="{{ $data->name }}"
                                    src="{{ asset('images/products/empty-default.png') }}" class="lazy aspect-4/3 w-full">
                            </picture>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper gallery-thumbs">
                    <div class="swiper-wrapper h-auto!">
                        <picture class="block swiper-slide">
                            <img data-src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}"
                                src="{{ asset('images/products/empty-default.png') }}" class="lazy aspect-4/3 block w-full">
                        </picture>
                        @foreach ($images as $image)
                            <picture class="block swiper-slide">
                                <img data-src="{{ asset('storage/' . $image->image) }}"
                                    src="{{ asset('images/products/empty-default.png') }}"loading="lazy"
                                    alt="{{ $data->name }}" class="lazy aspect-4/3 block w-full">
                            </picture>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-1/2">
                <div class="product-detail-information py-4 xl:p-0 xl:pl-4">
                    <div class="mb-2">
                        <p class="product-detail-category">
                            {{ __('Categoría') }}: <a
                                href="{{ route('category.index', ['categorySlug' => $category->slug]) }}">
                                {{ $category->name }}
                            </a>
                        </p>
                        @if ($data->code)
                            <p class="font-medium text-base">
                                <span class="icon"></span>
                                <strong>Código</strong> {{ $data->code }}
                            </p>
                        @endif
                    </div>
                    <h1 class="text-2xl font-bold mb-2">{{ $data->name }}</h1>
                    @if ($data->has_price && $data->final_price > 0)
                        <div class="mb-2">
                            <p class="font-medium text-xl">
                                {{ env('CURRENCY') }}{{ number_format($data->final_price, 0) }}
                            </p>
                            @if ($data->discount)
                                <div class="flex flex-nowrap">
                                    <div class="flex gap-2 items-center justify-center">
                                        <p class="font-medium text-lg line-through">
                                            {{ env('CURRENCY') }}{{ number_format($data->price, 0) }}
                                        </p>
                                        <span class="flex">
                                            {{ $data->discount }}%
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    @php
                        $data->url = route('product.detail', [
                            'categorySlug' => $data->category->slug,
                            'productSlug' => $data->slug,
                        ]);
                        $data->img = asset('storage/' . $data->image);
                    @endphp
                    <div class="widget_cart flex flex-col gap-4"
                        data-product="{{ json_encode($data->only(['id', 'name', 'image', 'img', 'price', 'discount', 'final_price', 'url'])) }}">

                        <div class="flex gap-2">

                            <div class="widget_cart-controllers inline-flex rounded-base shadow-xs -space-x-px"
                                role="group">
                                <button type="button"
                                    class="widget_cart-button less text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-3 focus:ring-neutral-tertiary-soft font-medium leading-5 rounded-s-base text-sm px-3 py-2 focus:outline-none"
                                    x-on:click="updateQuantity('decrement')">
                                    -
                                </button>
                                <input type="number" id="quantity-admin"
                                    class="widget_cart-input text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-3 focus:ring-neutral-tertiary-soft font-medium leading-5 text-sm px-3 py-2 focus:outline-none"
                                    value="1" min="1" max="99">
                                <button type="button"
                                    class="widget_cart-button plus text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-3 focus:ring-neutral-tertiary-soft font-medium leading-5 rounded-e-base text-sm px-3 py-2 focus:outline-none"
                                    x-on:click="updateQuantity('increment')">
                                    +
                                </button>
                            </div>
                            <button type="button"
                                class="widget_cart-add-button text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                <i class="icon"></i> {{ __('Agregar') }}
                            </button>

                        </div>

                        <div class="widget_cart-favorite">
                            <button
                                class="widget_cart-favorite-button favorite-button flex items-center gap-2 justify-center"
                                type="button">
                                <x-icon name="favorite" class="h-5 w-5" />
                                <span>
                                    <span class="add">{{ __('Agregar a') }}</span>
                                    <span class="remove">{{ __('Quitar de') }}</span> {{ __('favoritos') }}
                                </span>
                            </button>
                        </div>

                        <div class="flex flex-col gap-1 py-3">
                            <h4 class="font-bold">{{ __('Compartir') }}</h4>
                            <div class="shareon flex gap-2">
                                <a class="whatsapp" data-url="{{ $data->url }}" data-title="{{ $data->name }}">
                                    <x-icon name="whatsapp-lines" class="h-5 w-5" />
                                </a>
                                <a class="telegram" data-url="{{ $data->url }}" data-title="{{ $data->name }}">
                                    <x-icon name="telegram" class="h-5 w-5" />
                                </a>
                                <a class="facebook" data-url="{{ $data->url }}" data-title="{{ $data->name }}">
                                    <x-icon name="facebook" class="h-5 w-5" />
                                </a>
                                <a class="twitter" data-url="{{ $data->url }}" data-title="{{ $data->name }}">
                                    <x-icon name="X" class="h-5 w-5" />
                                </a>
                                <a class="email" data-url="{{ $data->url }}" data-title="{{ $data->name }}">
                                    <x-icon name="email" class="h-5 w-5" />
                                </a>
                            </div>
                        </div>
                        @isset($data->features)
                            <div
                                class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                                <table class="w-full text-sm text-left rtl:text-right text-body">
                                    <tbody>
                                        @foreach (collect($data->features ?? []) as $feature)
                                            <tr
                                                class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default">
                                                <td class="font-bold text-gray-700 px-6 py-4">
                                                    {{ data_get($feature, 'name', 'N/A') }}
                                                </td>
                                                <td class="font-bold text-gray-700 px-6 py-4">
                                                    {{ data_get($feature, 'value', '-') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <article class="w-full mb-3 py-3 text-gray-500">
            <h4 class="mb-5 text-xl font-extrabold">{{ __('Descripción') }}</h4>
            <div class="mb-10">
                {!! $data->description !!}
            </div>

        </article>
    </section>
@endsection

@section('bottom-section')
    <section class="featured-section bg-amber-50 pt-10 pb-10">
        <div class="mx-auto px-4 sm:px-6 lg:container">
            <x-title>{{ __('Productos relacionados') }}</x-title>
            @include('partials.related-products', ['products' => $relatedProducts])
        </div>
    </section>
@endsection
