@extends('layouts.seo', ['css' => 'about-section ' . $sectionName])

@section('title')
    {{ __('Sobre nosotros') }}
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
    <section class="bg-gray-100 p-4">
        <div class="container m-auto mb-6 py-5">
            <x-title icon="youtube">{{ __('Sobre nosotros') }}</x-title>
            <article class="py-5 pb-10">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id posuere lacus, id dictum lectus. Cras
                    nec suscipit ligula. Proin elementum rutrum tellus vitae accumsan. Cras sit amet augue interdum ipsum
                    tristique fermentum. Mauris facilisis ut libero eget congue. Curabitur ipsum libero, eleifend sit amet
                    arcu ac, gravida imperdiet diam. Integer ex metus, vestibulum nec arcu sed, feugiat posuere dolor.
                    Quisque ornare, arcu sit amet pretium eleifend, nulla velit malesuada sapien, vulputate efficitur erat
                    ante ut mi. Ut laoreet mauris neque, mattis tincidunt dolor ultricies ut. Aliquam sit amet interdum
                    augue. Proin bibendum egestas rutrum. Integer sed magna enim. Vivamus rutrum, ante ut mollis rutrum,
                    lorem augue elementum risus, et accumsan mauris purus eget purus. Praesent eleifend metus vitae erat
                    lobortis, ut mattis nisi volutpat. Sed porttitor ut tellus in ornare. Aliquam sed hendrerit tortor.
                </p>
                <p>
                    Nam blandit elementum augue, a faucibus elit. Morbi varius condimentum leo quis euismod. Mauris blandit
                    nisl vel lorem vehicula, sit amet rhoncus quam sollicitudin. Praesent id leo vel dolor interdum euismod
                    eget ac diam. Etiam eleifend leo quis ornare vestibulum. Phasellus pulvinar auctor varius. Vivamus
                    vehicula ligula lorem, non elementum ante commodo ut. Aliquam metus elit, blandit ac accumsan quis,
                    tincidunt et orci. Duis commodo tincidunt turpis at elementum. Donec eget augue ut quam consequat
                    congue. Vestibulum leo orci, consequat sit amet libero non, luctus dapibus massa. Sed condimentum nisl
                    at felis tincidunt, id fringilla tellus dapibus. Suspendisse nec tincidunt enim. Morbi pellentesque
                    condimentum nisi, in lacinia lorem gravida vitae. Fusce vehicula vel est blandit bibendum.
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
