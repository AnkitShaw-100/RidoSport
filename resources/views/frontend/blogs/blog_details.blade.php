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
                {!! $blog->formatted_content !!}
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
        background: linear-gradient(180deg, rgba(5, 10, 30, .24), rgba(5, 10, 30, .58));
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
        padding: 0 0 84px;
    }

    .rido-blog-detail-section-no-hero {
        padding-top: 72px;
    }

    .rido-blog-detail-container {
        max-width: 1040px;
        position: relative;
        width: 92%;
        z-index: 2;
    }

    .rido-blog-detail-article {
        background: #fff;
        border: 1px solid rgba(5, 10, 30, .08);
        border-radius: 8px;
        box-shadow: 0 24px 60px rgba(5, 10, 30, .12);
        margin-top: -64px;
        padding: 48px 58px 54px;
        width: 100%;
    }

    .rido-blog-detail-section-no-hero .rido-blog-detail-article {
        margin-top: 0;
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
        gap: 14px;
        margin-bottom: 18px;
        text-transform: uppercase;
    }

    .rido-blog-detail-meta i {
        color: var(--theme-color1, #971736);
        margin-right: 6px;
    }

    .rido-blog-detail-article h2 {
        color: #050a1e;
        font-size: 42px;
        font-weight: 500;
        letter-spacing: 0;
        line-height: 1.16;
        margin: 0 0 28px;
        overflow-wrap: anywhere;
    }

    .rido-blog-detail-article > h2::after {
        background: var(--theme-color1, #971736);
        border-radius: 999px;
        content: "";
        display: block;
        height: 3px;
        margin-top: 22px;
        width: 70px;
    }

    .rido-blog-detail-copy p {
        color: #3f4650;
        font-size: 18px;
        line-height: 1.88;
        margin-bottom: 20px;
        overflow-wrap: anywhere;
    }

    .rido-blog-detail-copy {
        overflow-wrap: anywhere;
        word-break: normal;
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
        margin: 34px 0 16px;
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
        margin: 30px 0;
        padding: 22px 24px;
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

    .rido-blog-detail-copy figure {
        margin: 30px 0;
    }

    .rido-blog-detail-copy figcaption {
        color: #7a7a7a;
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
    }

    .rido-blog-detail-copy table {
        border-collapse: collapse;
        display: block;
        margin: 30px 0;
        max-width: 100%;
        overflow-x: auto;
        width: 100%;
    }

    .rido-blog-detail-copy th,
    .rido-blog-detail-copy td {
        border: 1px solid #d9dde2;
        color: #3f4650;
        padding: 12px 14px;
        vertical-align: top;
    }

    .rido-blog-detail-copy th {
        background: #f4f4f4;
        color: #050a1e;
        font-weight: 700;
    }

    .rido-blog-detail-copy pre {
        background: #050a1e;
        border-radius: 8px;
        color: #fff;
        margin: 28px 0;
        overflow-x: auto;
        padding: 18px 20px;
    }

    .rido-blog-detail-copy code {
        font-family: Consolas, Monaco, monospace;
    }

    .rido-blog-detail-copy hr {
        border: 0;
        border-top: 1px solid #e5e7e9;
        margin: 34px 0;
    }

    .rido-blog-detail-copy iframe {
        aspect-ratio: 16 / 9;
        border: 0;
        border-radius: 8px;
        display: block;
        height: auto;
        margin: 30px 0;
        width: 100%;
    }

    .rido-blog-detail-copy strong,
    .rido-blog-detail-copy b {
        color: #050a1e;
        font-weight: 800;
    }

    .rido-related-blogs {
        margin-top: 48px;
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

    @media (max-width: 991px) {
        .rido-blog-detail-hero {
            min-height: 370px;
        }

        .rido-blog-detail-container {
            max-width: 760px;
            width: calc(100% - 32px);
        }

        .rido-blog-detail-article {
            padding: 38px 34px 44px;
        }

        .rido-blog-detail-article h2 {
            font-size: 36px;
        }

        .rido-blog-detail-copy h1 {
            font-size: 31px;
        }

        .rido-blog-detail-copy h2 {
            font-size: 27px;
        }

        .rido-blog-detail-copy h3 {
            font-size: 23px;
        }
    }

    @media (max-width: 767px) {
        .rido-blog-detail-hero {
            min-height: 300px;
        }

        .rido-blog-detail-section {
            padding: 0 0 56px;
        }

        .rido-blog-detail-section-no-hero {
            padding-top: 42px;
        }

        .rido-blog-detail-container {
            width: calc(100% - 24px);
        }

        .rido-blog-detail-article {
            margin-top: -34px;
            padding: 26px 20px 32px;
        }

        .rido-blog-detail-breadcrumb {
            flex-wrap: wrap;
            font-size: 12px;
            gap: 8px;
            line-height: 1.2;
        }

        .rido-blog-detail-meta {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .rido-blog-detail-article h2 {
            font-size: 29px;
            line-height: 1.2;
            margin-bottom: 24px;
        }

        .rido-blog-detail-copy p {
            font-size: 16px;
            line-height: 1.75;
        }

        .rido-blog-detail-copy h1 {
            font-size: 27px;
        }

        .rido-blog-detail-copy h2 {
            font-size: 24px;
        }

        .rido-blog-detail-copy h3 {
            font-size: 21px;
        }

        .rido-blog-detail-copy h4 {
            font-size: 19px;
        }

        .rido-blog-detail-copy ul,
        .rido-blog-detail-copy ol {
            font-size: 16px;
            line-height: 1.7;
            margin-left: 18px;
            padding-left: 14px;
        }

        .rido-blog-detail-copy blockquote {
            font-size: 16px;
            padding: 18px;
        }

        .rido-blog-detail-copy img {
            margin: 22px auto;
            max-height: none;
            width: 100%;
        }

        .rido-related-card {
            grid-template-columns: 1fr;
            margin-bottom: 16px;
        }

        .rido-related-card img {
            height: 190px;
        }
    }

    @media (max-width: 420px) {
        .rido-blog-detail-hero {
            min-height: 260px;
        }

        .rido-blog-detail-container {
            width: calc(100% - 18px);
        }

        .rido-blog-detail-article {
            border-radius: 7px;
            padding: 22px 16px 28px;
        }

        .rido-blog-detail-article h2 {
            font-size: 25px;
        }

        .rido-blog-detail-copy p {
            font-size: 15.5px;
            line-height: 1.72;
        }

        .rido-related-heading h3 {
            font-size: 24px;
        }

        .rido-related-card img {
            height: 170px;
        }
    }
</style>

@endsection
