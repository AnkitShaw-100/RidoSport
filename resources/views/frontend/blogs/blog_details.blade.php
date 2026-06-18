@extends('frontend.layout.main1')
@push('title')
<title>RidoSports | {{ $blog->title }}</title>
@endpush
@section('main-section1')

@php
    $hasBanner = ! empty($blog->banner_public_id)
        || (! empty($blog->banner_image_url) && ! str_contains($blog->banner_image_url, 'images/bg/blog-box.png'));
@endphp

@if ($hasBanner)
    <section class="page-title rido-blog-detail-hero" style="background-image: url('{{ $blog->banner_image_url }}');">
    </section>
@endif

<section class="rido-blog-detail-section {{ $hasBanner ? '' : 'rido-blog-detail-section-no-hero' }}">
    <div class="container rido-blog-detail-container">
        <article class="rido-blog-detail-article">
            <nav class="rido-blog-detail-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('blog') }}">Blogs</a>
            </nav>

            <div class="rido-blog-detail-meta">
                <span><i class="far fa-user"></i> RidoSports</span>
                <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('d F, Y') }}</span>
                <span><i class="far fa-clock"></i> {{ $blog->created_at->format('h:i A') }}</span>
            </div>

            <h2>{{ $blog->title }}</h2>

            <div class="rido-blog-detail-copy">
                @if ($blog->safe_content !== strip_tags($blog->safe_content))
                    {!! $blog->safe_content !!}
                @else
                    @foreach (preg_split("/\r\n|\n|\r/", $blog->safe_content) as $paragraph)
                        @if (trim($paragraph) !== '')
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach
                @endif
            </div>
        </article>

        @if ($recentBlogs->isNotEmpty())
            <div class="rido-related-blogs">
                <div class="rido-related-heading">
                    <span>More Updates</span>
                    <h3>Recent Blogs</h3>
                </div>

                <div class="row">
                    @foreach ($recentBlogs->take(2) as $recentBlog)
                        @php
                            $hasRecentBanner = ! empty($recentBlog->banner_public_id)
                                || (! empty($recentBlog->banner_image_url) && ! str_contains($recentBlog->banner_image_url, 'images/bg/blog-box.png'));
                        @endphp
                        <div class="col-md-6">
                            <a class="rido-related-card {{ $hasRecentBanner ? '' : 'rido-related-card-no-image' }}" href="{{ route('blog-details', $recentBlog) }}">
                                @if ($hasRecentBanner)
                                    <img src="{{ $recentBlog->banner_image_url }}" alt="{{ $recentBlog->title }}">
                                @endif
                                <div>
                                    <p>{{ $recentBlog->created_at->format('M d, Y') }}</p>
                                    @php
                                        $relatedTitle = strlen($recentBlog->title) > 76 ? substr($recentBlog->title, 0, 76) . '...' : $recentBlog->title;
                                    @endphp
                                    <h4>{{ $relatedTitle }}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .rido-blog-detail-hero {
        background-position: center center;
        background-size: cover;
        min-height: 430px;
        position: relative;
    }

    .rido-blog-detail-hero::before {
        background: rgba(5, 10, 30, .45);
        bottom: 0;
        content: "";
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    .rido-blog-detail-hero .auto-container {
        position: relative;
        z-index: 1;
    }

    .rido-blog-detail-section {
        background: #f4f4f4;
        padding: 84px 0;
    }

    .rido-blog-detail-section-no-hero {
        padding-top: 120px;
    }

    .rido-blog-detail-container {
        max-width: 1360px;
        width: 94%;
    }

    .rido-blog-detail-article {
        background: #fff;
        border: 1px solid rgba(5, 10, 30, .08);
        border-radius: 8px;
        box-shadow: 0 16px 38px rgba(5, 10, 30, .08);
        padding: 44px;
        width: 100%;
    }

    .rido-blog-detail-breadcrumb {
        align-items: center;
        background: rgba(151, 23, 54, .08);
        border-radius: 6px;
        color: #050a1e;
        display: inline-flex;
        font-size: 13px;
        font-weight: 700;
        gap: 10px;
        margin-bottom: 22px;
        padding: 10px 14px;
    }

    .rido-blog-detail-breadcrumb a {
        color: #050a1e;
        text-decoration: none;
    }

    .rido-blog-detail-breadcrumb a:hover {
        color: var(--theme-color1, #971736);
    }

    .rido-blog-detail-breadcrumb span,
    .rido-blog-detail-breadcrumb i {
        color: var(--theme-color1, #971736);
        font-size: 10px;
    }

    .rido-blog-detail-meta {
        align-items: center;
        color: #7a7a7a;
        display: flex;
        flex-wrap: wrap;
        font-size: 13px;
        gap: 16px;
        margin-bottom: 16px;
        text-transform: uppercase;
    }

    .rido-blog-detail-meta i {
        color: var(--theme-color1, #971736);
        margin-right: 6px;
    }

    .rido-blog-detail-article h2 {
        color: #050a1e;
        font-size: 38px;
        font-weight: 500;
        line-height: 1.2;
        margin: 0 0 24px;
        overflow-wrap: anywhere;
    }

    .rido-blog-detail-copy p {
        color: #444;
        font-size: 17px;
        line-height: 1.9;
        margin-bottom: 18px;
        overflow-wrap: anywhere;
    }

    .rido-blog-detail-copy h1,
    .rido-blog-detail-copy h2,
    .rido-blog-detail-copy h3,
    .rido-blog-detail-copy h4,
    .rido-blog-detail-copy h5,
    .rido-blog-detail-copy h6 {
        color: #050a1e;
        font-weight: 600;
        line-height: 1.25;
        margin: 28px 0 14px;
        overflow-wrap: anywhere;
    }

    .rido-blog-detail-copy h1 {
        font-size: 34px;
    }

    .rido-blog-detail-copy h2 {
        font-size: 30px;
    }

    .rido-blog-detail-copy h3 {
        font-size: 25px;
    }

    .rido-blog-detail-copy h4 {
        font-size: 21px;
    }

    .rido-blog-detail-copy ul,
    .rido-blog-detail-copy ol {
        color: #444;
        font-size: 17px;
        line-height: 1.85;
        margin: 0 0 22px 24px;
        padding-left: 18px;
    }

    .rido-blog-detail-copy li {
        margin-bottom: 9px;
    }

    .rido-blog-detail-copy blockquote {
        background: rgba(151, 23, 54, .07);
        border-left: 4px solid var(--theme-color1, #971736);
        color: #233e50;
        font-size: 18px;
        font-style: italic;
        line-height: 1.75;
        margin: 26px 0;
        padding: 18px 22px;
    }

    .rido-blog-detail-copy a {
        color: var(--theme-color1, #971736);
        font-weight: 700;
        text-decoration: underline;
    }

    .rido-blog-detail-copy img {
        border-radius: 8px;
        display: block;
        height: auto;
        margin: 28px auto;
        max-height: 620px;
        max-width: 100%;
        object-fit: cover;
        width: auto;
    }

    .rido-blog-detail-copy strong,
    .rido-blog-detail-copy b {
        color: #050a1e;
        font-weight: 800;
    }

    .rido-related-blogs {
        margin-top: 42px;
    }

    .rido-related-heading {
        margin-bottom: 18px;
    }

    .rido-related-heading span {
        color: var(--theme-color1, #971736);
        display: block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .rido-related-heading h3 {
        color: #050a1e;
        font-size: 28px;
        font-weight: 500;
        margin: 0;
    }

    .rido-related-card {
        background: #fff;
        border: 1px solid rgba(5, 10, 30, .08);
        border-radius: 8px;
        box-shadow: 0 12px 30px rgba(5, 10, 30, .07);
        display: grid;
        gap: 16px;
        grid-template-columns: 170px 1fr;
        height: 100%;
        overflow: hidden;
        padding: 14px;
        text-decoration: none;
    }

    .rido-related-card-no-image {
        display: block;
        padding: 24px;
    }

    .rido-related-card img {
        border-radius: 6px;
        height: 120px;
        object-fit: cover;
        width: 100%;
    }

    .rido-related-card p {
        color: #7a7a7a;
        font-size: 13px;
        margin: 4px 0 8px;
    }

    .rido-related-card h4 {
        color: #050a1e;
        font-size: 20px;
        font-weight: 500;
        line-height: 1.35;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .rido-related-card:hover h4 {
        color: var(--theme-color1, #971736);
    }

    @media (max-width: 767px) {
        .rido-blog-detail-hero {
            min-height: 310px;
        }

        .rido-blog-detail-section {
            padding: 56px 0;
        }

        .rido-blog-detail-section-no-hero {
            padding-top: 82px;
        }

        .rido-blog-detail-container {
            width: 100%;
        }

        .rido-blog-detail-article {
            padding: 26px 20px;
        }

        .rido-blog-detail-article h2 {
            font-size: 28px;
        }

        .rido-blog-detail-copy p {
            font-size: 16px;
        }

        .rido-related-card {
            grid-template-columns: 1fr;
            margin-bottom: 16px;
        }

        .rido-related-card img {
            height: 190px;
        }
    }
</style>

@endsection
