@extends('layouts.seo', ['css' => 'policies-section ' . $sectionName])

@section('title')
    {{ __('Nuestras políticas') }}
@endsection

@section('preload')
@endsection

@section('banner')
    <picture class="block w-full top-small-banner">
        <source srcset="{{ asset('images/banners/top-banner.jpg') }}" media="(min-width: 768px)">
        <img src="{{ asset('images/banners/top-banner2.jpg') }}" alt="Top Banner" class="block w-full">
    </picture>
@endsection


@section('content')
    <section class="bg-gray-100 p-4">
        <div class="container m-auto mb-6 py-5">
            <x-title icon="youtube">{{ __('Nuestras políticas') }}</x-title>
            <article class="py-5 pb-10">
                <p>
                    Donec euismod, lectus eu blandit pretium, tellus turpis feugiat est, a rutrum tellus metus non justo.
                    Etiam posuere, nulla a ornare eleifend, leo orci feugiat massa, vitae rhoncus erat tortor eu est.
                    Vivamus auctor nisl purus, sed accumsan lorem ultrices et. Fusce sagittis dapibus tellus sit amet
                    feugiat. Quisque gravida, metus quis sollicitudin mollis, leo sapien rhoncus urna, commodo lobortis
                    risus tellus non augue. Suspendisse ut venenatis leo, at porta sapien. Praesent a mauris aliquam,
                    blandit velit eu, luctus magna.
                </p>
                <p>
                    Donec euismod, lectus eu blandit pretium, tellus turpis feugiat est, a rutrum tellus metus non justo.
                    Etiam posuere, nulla a ornare eleifend, leo orci feugiat massa, vitae rhoncus erat tortor eu est.
                    Vivamus auctor nisl purus, sed accumsan lorem ultrices et. Fusce sagittis dapibus tellus sit amet
                    feugiat. Quisque gravida, metus quis sollicitudin mollis, leo sapien rhoncus urna, commodo lobortis
                    risus tellus non augue. Suspendisse ut venenatis leo, at porta sapien. Praesent a mauris aliquam,
                    blandit velit eu, luctus magna.
                </p>
            </article>
        </div>
    </section>
@endsection

@section('bottom-section')
    <section class="featured-section bg-amber-50 pb-10">
        <div class="mx-auto p-4 sm:px-6 lg:container">
            <x-title class="white">{{ __('Destacados') }}</x-title>
            @include('partials.featured-slider-products')
        </div>
    </section>
@endsection
