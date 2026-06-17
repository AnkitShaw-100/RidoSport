@extends('frontend.layout.main1')
@push('title')
<title>Desan International | Blogs</title>
@endpush
@section('main-section1')
<section class="page-title" style="background-image: url('{{ asset('images/bg/3.png') }}');">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{$pageTitle}}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{$pageRoute}}">{{$pageTitle}}</a></li>
            </ul>
        </div>
    </div>
</section>

@include('frontend.blogs.blog_content') 

@endsection