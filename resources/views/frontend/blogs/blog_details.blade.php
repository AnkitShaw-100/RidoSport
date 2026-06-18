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
                <li>{{ Str::limit($blog->title, 34) }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="rido-blog-detail-section">
    <div class="container">
        <div class="row rido-blog-detail-layout">
            <div class="col-lg-8">
                <article class="rido-blog-detail-card">
                    <div class="rido-blog-detail-image">
                        <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}">
                    </div>

                    <div class="rido-blog-detail-content">
                        <div class="rido-blog-detail-meta">
                            <span><i class="far fa-user"></i> RidoSports</span>
                            <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('d F, Y') }}</span>
                            <span><i class="far fa-clock"></i> {{ $blog->created_at->format('h:i A') }}</span>
                        </div>

                        <h2>{{ $blog->title }}</h2>

                        <div class="rido-blog-detail-copy">
                            @foreach (preg_split("/\r\n|\n|\r/", $blog->content) as $paragraph)
                                @if (trim($paragraph) !== '')
                                    <p>{{ $paragraph }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <aside class="rido-blog-sidebar">
                    <div class="rido-blog-sidebar-title">
                        <span>More Updates</span>
                        <h3>Recent Blogs</h3>
                    </div>

                    @forelse ($recentBlogs as $recentBlog)
                        <a class="rido-recent-blog" href="{{ route('blog-details', $recentBlog) }}">
                            <img src="{{ $recentBlog->banner_image_url }}" alt="{{ $recentBlog->title }}">
                            <div>
                                <h4>{{ Str::limit($recentBlog->title, 58) }}</h4>
                                <p>{{ $recentBlog->created_at->format('M d, Y') }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="rido-blog-sidebar-empty">No other blogs available.</p>
                    @endforelse
                </aside>
            </div>
        </div>
    </div>
</section>

<style>
    .rido-blog-detail-section {
        background: #f4f4f4;
        padding: 90px 0;
    }

    .rido-blog-detail-layout {
        row-gap: 28px;
    }

    .rido-blog-detail-card,
    .rido-blog-sidebar {
        background: #fff;
        border: 1px solid rgba(5, 10, 30, .08);
        border-radius: 8px;
        box-shadow: 0 16px 38px rgba(5, 10, 30, .08);
        overflow: hidden;
    }

    .rido-blog-detail-image {
        background: #e9e9e9;
        height: 430px;
        overflow: hidden;
    }

    .rido-blog-detail-image img {
        display: block;
        height: 100%;
        object-fit: cover;
        width: 100%;
    }

    .rido-blog-detail-content {
        padding: 34px;
    }

    .rido-blog-detail-meta {
        align-items: center;
        color: #7a7a7a;
        display: flex;
        flex-wrap: wrap;
        font-size: 13px;
        gap: 15px;
        margin-bottom: 16px;
        text-transform: uppercase;
    }

    .rido-blog-detail-meta i {
        color: var(--theme-color1, #971736);
        margin-right: 6px;
    }

    .rido-blog-detail-content h2 {
        color: #050a1e;
        font-size: 36px;
        font-weight: 500;
        line-height: 1.2;
        margin: 0 0 20px;
        overflow-wrap: anywhere;
    }

    .rido-blog-detail-copy p {
        color: #444;
        font-size: 17px;
        line-height: 1.85;
        margin-bottom: 18px;
        overflow-wrap: anywhere;
    }

    .rido-blog-sidebar {
        padding: 24px;
        position: sticky;
        top: 90px;
    }

    .rido-blog-sidebar-title {
        border-bottom: 1px solid #e9e9e9;
        margin-bottom: 18px;
        padding-bottom: 16px;
    }

    .rido-blog-sidebar-title span {
        color: var(--theme-color1, #971736);
        display: block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .rido-blog-sidebar-title h3 {
        color: #050a1e;
        font-size: 24px;
        font-weight: 500;
        margin: 0;
    }

    .rido-recent-blog {
        align-items: center;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        gap: 13px;
        padding: 14px 0;
        text-decoration: none;
    }

    .rido-recent-blog:last-child {
        border-bottom: 0;
    }

    .rido-recent-blog img {
        border-radius: 6px;
        height: 74px;
        object-fit: cover;
        width: 92px;
    }

    .rido-recent-blog h4 {
        color: #050a1e;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.35;
        margin: 0 0 6px;
        overflow-wrap: anywhere;
    }

    .rido-recent-blog:hover h4 {
        color: var(--theme-color1, #971736);
    }

    .rido-recent-blog p,
    .rido-blog-sidebar-empty {
        color: #7a7a7a;
        font-size: 13px;
        margin: 0;
    }

    @media (max-width: 991px) {
        .rido-blog-sidebar {
            position: static;
        }
    }

    @media (max-width: 767px) {
        .rido-blog-detail-section {
            padding: 60px 0;
        }

        .rido-blog-detail-image {
            height: 260px;
        }

        .rido-blog-detail-content {
            padding: 24px 20px;
        }

        .rido-blog-detail-content h2 {
            font-size: 28px;
        }

        .rido-blog-detail-copy p {
            font-size: 16px;
        }
    }
</style>

@endsection
