@extends('frontend.layout.main1')

@push('title')
<title>Desan International | {{ $pageTitle }}</title>
@endpush

@section('main-section1')
@php
    $formatImageUrl = function ($path) {
        if (empty($path)) {
            return null;
        }

        return preg_match('/^https?:\/\//i', $path) ? $path : asset($path);
    };

    $shortText = function ($value, $limit = 130) {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $value)));

        if (strlen($text) <= $limit) {
            return $text;
        }

        return rtrim(substr($text, 0, $limit), " \t\n\r\0\x0B.,") . '...';
    };
@endphp

<section class="page-title rido-products-page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{ $pageTitle }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li>{{ $pageTitle }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="rido-product-range-page">
    <div class="container">
        <div class="rido-range-intro">
            <span>Product Range</span>
            <h2>{{ $pageTitle }}</h2>
            <p>Select a product below to view full details, specifications, gallery, and advantages.</p>
        </div>

        <div class="rido-range-grid">
            @foreach($catalogItems as $item)
                @php
                    if ($rangeType === 'equipment') {
                        $details = $item->equipment->first();
                        $image = $formatImageUrl(optional($details)->image);
                        $description = $shortText(optional($details)->description);
                        $itemRoute = route('equipment.show', ['slug' => $item->slug]);
                        $kicker = 'Sports Equipment';
                    } else {
                        $details = $item->products->first();
                        $image = $formatImageUrl(optional($details)->image);
                        $description = $shortText(optional($details)->description);
                        $itemRoute = $item->parent_id
                            ? route('subproduct.show', [$parentGroup->slug, $item->slug])
                            : route('product.show', $item->slug);
                        $kicker = $item->parent_id ? $parentGroup->name : 'Product';
                    }
                @endphp

                <article class="rido-range-card">
                    <a class="rido-range-card-media {{ $image ? '' : 'is-placeholder' }}" href="{{ $itemRoute }}">
                        @if($image)
                            <img src="{{ $image }}" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('images/logo/logo-re.png') }}" alt="{{ $item->name }}">
                        @endif
                    </a>

                    <div class="rido-range-card-body">
                        <span>{{ $kicker }}</span>
                        <h3><a href="{{ $itemRoute }}">{{ $item->name }}</a></h3>
                        <p>{{ $description ?: 'Open this product to view all details and images.' }}</p>
                        <a class="rido-range-card-action" href="{{ $itemRoute }}">View Details</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
    .rido-products-page-title {
        align-items: center;
        background-image: linear-gradient(90deg, rgba(7, 17, 38, .76), rgba(151, 23, 54, .28)), url('{{ asset('images/bg/about-banner.png') }}');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        box-shadow: 0 4px 18px rgba(5, 10, 30, .08);
        display: flex;
        min-height: 390px;
        padding: 110px 0 86px;
    }

    .rido-products-page-title .title {
        color: #fff;
        font-size: 58px;
        font-weight: 700;
        line-height: 1.08;
        margin-bottom: 22px;
        text-shadow: 0 14px 28px rgba(0, 0, 0, .28);
    }

    .rido-products-page-title .page-breadcrumb {
        background: rgba(151, 23, 54, .84);
        border-radius: 2px;
        display: inline-flex;
        gap: 10px;
        padding: 11px 16px;
    }

    .rido-products-page-title .page-breadcrumb,
    .rido-products-page-title .page-breadcrumb a,
    .rido-products-page-title .page-breadcrumb li {
        color: #fff;
    }

    .rido-product-range-page {
        background: #f7f8fb;
        padding: 64px 0 100px;
    }

    .rido-product-range-page .container {
        max-width: 1180px;
    }

    .rido-range-intro {
        margin: 0 auto 38px;
        max-width: 780px;
        text-align: center;
    }

    .rido-range-intro span,
    .rido-range-card-body span {
        color: var(--theme-color1, #971736);
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .rido-range-intro h2 {
        color: #233e50;
        font-size: 42px;
        font-weight: 700;
        line-height: 1.15;
        margin: 10px 0 14px;
    }

    .rido-range-intro p {
        color: #646b78;
        font-size: 17px;
        line-height: 1.75;
        margin: 0;
    }

    .rido-range-grid {
        display: grid;
        gap: 28px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .rido-range-card {
        background: #fff;
        border: 1px solid rgba(151, 23, 54, .16);
        border-radius: 16px;
        box-shadow: 0 14px 32px rgba(5, 10, 30, .07);
        display: flex;
        flex-direction: column;
        min-height: 100%;
        overflow: hidden;
        transition: border-color .22s ease, box-shadow .22s ease;
    }

    .rido-range-card:hover {
        border-color: rgba(151, 23, 54, .38);
        box-shadow: 0 18px 40px rgba(5, 10, 30, .1);
    }

    .rido-range-card-media {
        background: #eef1f5;
        display: flex;
        height: 225px;
        overflow: hidden;
        width: 100%;
    }

    .rido-range-card-media img {
        display: block;
        height: 100%;
        object-fit: cover;
        transition: transform .32s ease;
        width: 100%;
    }

    .rido-range-card:hover .rido-range-card-media img {
        transform: scale(1.035);
    }

    .rido-range-card-media.is-placeholder {
        align-items: center;
        background: linear-gradient(135deg, #f7f4f5, #ffffff);
        justify-content: center;
        padding: 34px;
    }

    .rido-range-card-media.is-placeholder img {
        height: auto;
        max-height: 110px;
        object-fit: contain;
        opacity: .86;
        width: 76%;
    }

    .rido-range-card:hover .rido-range-card-media.is-placeholder img {
        transform: none;
    }

    .rido-range-card-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 24px;
    }

    .rido-range-card-body h3 {
        font-size: 22px;
        font-weight: 700;
        line-height: 1.35;
        margin: 8px 0 14px;
    }

    .rido-range-card-body h3 a {
        color: #071126;
    }

    .rido-range-card-body h3 a:hover {
        color: var(--theme-color1, #971736);
    }

    .rido-range-card-body p {
        color: #626873;
        font-size: 15px;
        line-height: 1.7;
        margin: 0 0 24px;
    }

    .rido-range-card-action {
        align-items: center;
        background: var(--theme-color1, #971736);
        border-radius: 999px;
        color: #fff;
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        justify-content: center;
        margin-top: auto;
        min-height: 42px;
        padding: 11px 22px;
        text-transform: uppercase;
        width: max-content;
    }

    .rido-range-card-action:hover {
        background: #071126;
        color: #fff;
    }

    @media (max-width: 991px) {
        .rido-range-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .rido-products-page-title .title {
            font-size: 46px;
        }
    }

    @media (max-width: 575px) {
        .rido-range-grid {
            grid-template-columns: 1fr;
        }

        .rido-products-page-title .title {
            font-size: 34px;
        }

        .rido-range-intro h2 {
            font-size: 30px;
        }
    }
</style>
@endpush
