@extends('frontend.layout.main1')
@push('title')
<title>RidoSports | {{ $blog->title }}</title>
@endpush
@section('main-section1')

<section class="page-title" style="background-image: url('{{ asset('images/bg/3.png') }}');">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{ $blog->title }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('blog') }}">Blogs</a></li>
                <li>{{ $blog->title }}</li>
            </ul>
        </div>
    </div>
</section>

<div class="blog-details-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-details-thumb">
                            <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="blog-details-content">
                            <div class="meta-blog">
                                <span class="mate-text">By RidoSports</span>
                                <span><i class="fas fa-calendar-alt"></i>{{ $blog->created_at->format('d F, Y') }}</span>
                                <span><i class="fas fa-clock"></i>{{ $blog->created_at->format('h:i A') }}</span>
                            </div>
                            <h4 class="blog-details-title">{{ $blog->title }}</h4>

                            @foreach (preg_split("/\r\n|\n|\r/", $blog->content) as $paragraph)
                                @if (trim($paragraph) !== '')
                                    <p class="blog-details-desc">{{ $paragraph }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-sidber">
                            <div class="widget-sidber-content">
                                <h4>Recent Blogs</h4>
                            </div>

                            @forelse ($recentBlogs as $recentBlog)
                                <div class="sidber-widget-recent-post">
                                    <div class="recent-widget-thumb">
                                        <img src="{{ $recentBlog->banner_image_url }}" alt="{{ $recentBlog->title }}">
                                    </div>
                                    <div class="recent-widget-content">
                                        <a href="{{ route('blog-details', $recentBlog) }}">{{ $recentBlog->title }}</a>
                                        <p>{{ $recentBlog->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>No other blogs available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
