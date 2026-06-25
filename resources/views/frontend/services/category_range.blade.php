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

    $firstProjectImage = function ($project) {
        if (! $project || empty($project->images)) {
            return null;
        }

        $images = json_decode($project->images, true);

        if (is_array($images) && ! empty($images)) {
            return $images[0];
        }

        return trim((string) $project->images, " \t\n\r\0\x0B\"'");
    };

    $shortText = function ($value, $limit = 135) {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $value)));

        if (strlen($text) <= $limit) {
            return $text;
        }

        return rtrim(substr($text, 0, $limit), " \t\n\r\0\x0B.,") . '...';
    };
@endphp

<section class="page-title rido-services-page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{ $pageTitle }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('services.index') }}">Services</a></li>
                <li>{{ $pageTitle }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="rido-service-range-page">
    <div class="container">
        <div class="rido-service-range-intro">
            <span>Service Range</span>
            <h2>{{ $pageTitle }}</h2>
            <p>Select a service below to view project details, images, and the complete service information.</p>
        </div>

        <div class="rido-service-range-grid">
            @foreach($catalogItems as $item)
                @php
                    $details = $item->projects->first();
                    $image = $formatImageUrl($firstProjectImage($details));
                    $description = $shortText(optional($details)->description);
                    $itemRoute = $item->parent_id
                        ? route('subservice.show', [$parentGroup->slug, $item->slug])
                        : route('service.show', $item->slug);
                    $kicker = $item->parent_id ? $parentGroup->name : 'Service';
                @endphp

                <article class="rido-service-range-card">
                    <a class="rido-service-range-card-media {{ $image ? '' : 'is-placeholder' }}" href="{{ $itemRoute }}">
                        @if($image)
                            <img src="{{ $image }}" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('images/logo/logo-re.png') }}" alt="{{ $item->name }}">
                        @endif
                    </a>

                    <div class="rido-service-range-card-body">
                        <span>{{ $kicker }}</span>
                        <h3><a href="{{ $itemRoute }}">{{ $item->name }}</a></h3>
                        <p>{{ $description ?: 'Open this service to view related project images and service details.' }}</p>
                        <a class="rido-service-range-card-action" href="{{ $itemRoute }}">View Details</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
    .rido-services-page-title {
        align-items: center;
        background-image: linear-gradient(90deg, rgba(7, 17, 38, .76), rgba(151, 23, 54, .28)), url('{{ asset('images/bg/service-bg.png') }}');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        box-shadow: 0 4px 18px rgba(5, 10, 30, .08);
        display: flex;
        min-height: 390px;
        padding: 110px 0 86px;
    }

    .rido-services-page-title .title {
        color: #fff;
        font-size: 58px;
        font-weight: 700;
        line-height: 1.08;
        margin-bottom: 22px;
        text-shadow: 0 14px 28px rgba(0, 0, 0, .28);
    }

    .rido-services-page-title .page-breadcrumb {
        background: rgba(151, 23, 54, .84);
        border-radius: 2px;
        display: inline-flex;
        gap: 10px;
        padding: 11px 16px;
    }

    .rido-services-page-title .page-breadcrumb,
    .rido-services-page-title .page-breadcrumb a,
    .rido-services-page-title .page-breadcrumb li {
        color: #fff;
    }

    .rido-service-range-page {
        background: #f7f8fb;
        padding: 64px 0 100px;
    }

    .rido-service-range-page .container {
        max-width: 1180px;
    }

    .rido-service-range-intro {
        margin: 0 auto 38px;
        max-width: 780px;
        text-align: center;
    }

    .rido-service-range-intro span,
    .rido-service-range-card-body span {
        color: var(--theme-color1, #971736);
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .rido-service-range-intro h2 {
        color: #233e50;
        font-size: 42px;
        font-weight: 700;
        line-height: 1.15;
        margin: 10px 0 14px;
    }

    .rido-service-range-intro p {
        color: #646b78;
        font-size: 17px;
        line-height: 1.75;
        margin: 0;
    }

    .rido-service-range-grid {
        display: grid;
        gap: 28px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .rido-service-range-card {
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

    .rido-service-range-card:hover {
        border-color: rgba(151, 23, 54, .38);
        box-shadow: 0 18px 40px rgba(5, 10, 30, .1);
    }

    .rido-service-range-card-media {
        background: #eef1f5;
        display: flex;
        height: 225px;
        overflow: hidden;
        width: 100%;
    }

    .rido-service-range-card-media img {
        display: block;
        height: 100%;
        object-fit: cover;
        transition: transform .32s ease;
        width: 100%;
    }

    .rido-service-range-card:hover .rido-service-range-card-media img {
        transform: scale(1.035);
    }

    .rido-service-range-card-media.is-placeholder {
        align-items: center;
        background: linear-gradient(135deg, #f7f4f5, #ffffff);
        justify-content: center;
        padding: 34px;
    }

    .rido-service-range-card-media.is-placeholder img {
        height: auto;
        max-height: 110px;
        object-fit: contain;
        opacity: .86;
        width: 76%;
    }

    .rido-service-range-card:hover .rido-service-range-card-media.is-placeholder img {
        transform: none;
    }

    .rido-service-range-card-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 24px;
    }

    .rido-service-range-card-body h3 {
        font-size: 22px;
        font-weight: 700;
        line-height: 1.35;
        margin: 8px 0 14px;
    }

    .rido-service-range-card-body h3 a {
        color: #071126;
    }

    .rido-service-range-card-body h3 a:hover {
        color: var(--theme-color1, #971736);
    }

    .rido-service-range-card-body p {
        color: #626873;
        font-size: 15px;
        line-height: 1.7;
        margin: 0 0 24px;
    }

    .rido-service-range-card-action {
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

    .rido-service-range-card-action:hover {
        background: #071126;
        color: #fff;
    }

    @media (max-width: 991px) {
        .rido-service-range-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .rido-services-page-title .title {
            font-size: 46px;
        }
    }

    @media (max-width: 575px) {
        .rido-service-range-grid {
            grid-template-columns: 1fr;
        }

        .rido-services-page-title .title {
            font-size: 34px;
        }

        .rido-service-range-intro h2 {
            font-size: 30px;
        }
    }
</style>
@endpush
