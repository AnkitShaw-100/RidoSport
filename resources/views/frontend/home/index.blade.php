@extends('frontend.layout.main')

@section('main-section')

    @include('frontend.banner.index')
    @include('frontend.home.home_about')

    @include('frontend.home.service_content')

    @include('frontend.products.index')
    @include('frontend.blogs.blog_content')

    @include('frontend.home.why_us_content')

    @include('frontend.clients.index')
    @include('frontend.certificates.index')
    @include('frontend.testimonials.index')
    {{-- @include('frontend.testimonials.index_copy') --}}


@endsection