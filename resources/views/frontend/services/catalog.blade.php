@extends('frontend.layout.main1')

@push('title')
<title>Desan International | Services</title>
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

    $serviceImage = function ($service) use ($firstProjectImage, $formatImageUrl) {
        $image = $firstProjectImage($service->projects->first());

        if (! $image) {
            foreach ($service->subServices as $subService) {
                $image = $firstProjectImage($subService->projects->first());

                if ($image) {
                    break;
                }
            }
        }

        return $formatImageUrl($image);
    };
@endphp

<section class="page-title rido-services-page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Services</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Services</li>
            </ul>
        </div>
    </div>
</section>

<section class="rido-service-catalog">
    <div class="container">
        <div class="rido-service-intro">
            <span class="rido-service-kicker">RidoSports Service Range</span>
            <h2>Explore Our Complete Service Catalog</h2>
            <p>Select a service category to open its dedicated service range or detail page.</p>
        </div>

        <div class="rido-service-category-grid" aria-label="Service categories">
            @forelse($serviceGroups as $group)
                @php
                    $catalogItems = collect();

                    if ($group->projects->isNotEmpty() || $group->subServices->isEmpty()) {
                        $catalogItems->push($group);
                    }

                    foreach ($group->subServices as $subService) {
                        $catalogItems->push($subService);
                    }

                    $categoryImage = $serviceImage($group);
                    $categoryRoute = $catalogItems->count() > 1
                        ? route('service-category.show', $group->slug)
                        : ($catalogItems->first()->parent_id
                            ? route('subservice.show', [$group->slug, $catalogItems->first()->slug])
                            : route('service.show', $catalogItems->first()->slug));
                @endphp

                @if($catalogItems->isNotEmpty())
                    <a class="rido-service-category-card" href="{{ $categoryRoute }}">
                        <span class="rido-service-category-media {{ $categoryImage ? '' : 'is-placeholder' }}">
                            @if($categoryImage)
                                <img src="{{ $categoryImage }}" alt="{{ $group->name }}">
                            @else
                                <img src="{{ asset('images/logo/logo-re.png') }}" alt="{{ $group->name }}">
                            @endif
                        </span>
                        <span class="rido-service-category-content">
                            <span class="rido-service-category-kicker">Service Category</span>
                            <strong>{{ $group->name }}</strong>
                            <span class="rido-service-category-meta">{{ $catalogItems->count() }} {{ $catalogItems->count() === 1 ? 'service' : 'services' }}</span>
                            <span class="rido-service-category-action">{{ $catalogItems->count() > 1 ? 'View Service Range' : 'View Details' }}</span>
                        </span>
                    </a>
                @endif
            @empty
                <div class="rido-service-empty">
                    <h3>No services found</h3>
                    <p>Add service categories from the admin panel to show them here.</p>
                </div>
            @endforelse
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
        min-height: 430px;
        padding: 120px 0 96px;
    }

    .rido-services-page-title .title-outer {
        color: #fff;
        max-width: 640px;
    }

    .rido-services-page-title .title {
        color: #fff;
        font-size: 68px;
        font-weight: 700;
        line-height: 1.05;
        margin-bottom: 24px;
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

    .rido-service-catalog {
        background: #f7f8fb;
        overflow: hidden;
        padding: 18px 0 100px !important;
        position: relative;
    }

    .rido-service-catalog::before {
        background: radial-gradient(circle, rgba(151, 23, 54, .08) 0 2px, transparent 3px);
        background-size: 24px 24px;
        content: "";
        height: 360px;
        left: -70px;
        opacity: .65;
        position: absolute;
        top: 35px;
        width: 300px;
    }

    .rido-service-catalog .container {
        max-width: 1180px;
        position: relative;
        z-index: 1;
    }

    .rido-service-intro {
        margin: 0 auto 30px;
        max-width: 780px;
        text-align: center;
    }

    .rido-service-kicker {
        color: var(--theme-color1, #971736);
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .rido-service-intro h2 {
        color: #233e50;
        font-size: 44px;
        font-weight: 700;
        line-height: 1.15;
        margin: 10px 0 14px;
    }

    .rido-service-intro p {
        color: #646b78;
        font-size: 17px;
        line-height: 1.75;
        margin: 0;
    }

    .rido-service-category-grid {
        display: grid;
        gap: 22px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .rido-service-category-card {
        background: linear-gradient(180deg, #ffffff 0%, #fbfcff 100%);
        border: 1px solid rgba(151, 23, 54, .16);
        border-radius: 16px;
        box-shadow: 0 12px 28px rgba(5, 10, 30, .06);
        color: #071126;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        overflow: hidden;
        position: relative;
        transition: background .22s ease, border-color .22s ease, box-shadow .22s ease;
    }

    .rido-service-category-card:hover {
        background: #fff;
        border-color: rgba(151, 23, 54, .44);
        box-shadow: 0 18px 38px rgba(5, 10, 30, .1);
        color: #071126;
    }

    .rido-service-category-media {
        background: #eef1f5;
        display: flex;
        height: 230px;
        overflow: hidden;
        width: 100%;
    }

    .rido-service-category-media img {
        display: block;
        height: 100%;
        object-fit: cover;
        transition: transform .32s ease;
        width: 100%;
    }

    .rido-service-category-card:hover .rido-service-category-media img {
        transform: scale(1.035);
    }

    .rido-service-category-media.is-placeholder {
        align-items: center;
        background: linear-gradient(135deg, #f7f4f5, #ffffff);
        justify-content: center;
        padding: 35px;
    }

    .rido-service-category-media.is-placeholder img {
        height: auto;
        max-height: 115px;
        object-fit: contain;
        opacity: .86;
        width: 76%;
    }

    .rido-service-category-card:hover .rido-service-category-media.is-placeholder img {
        transform: none;
    }

    .rido-service-category-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 24px;
    }

    .rido-service-category-kicker {
        color: var(--theme-color1, #971736);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .08em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .rido-service-category-card strong {
        display: block;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 14px;
    }

    .rido-service-category-meta {
        color: #626873;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .rido-service-category-action {
        align-items: center;
        color: var(--theme-color1, #971736);
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        margin-top: auto;
        text-transform: uppercase;
    }

    .rido-service-category-action::after {
        content: ">";
        display: inline-block;
        margin-left: 9px;
        transition: transform .22s ease;
    }

    .rido-service-category-card:hover .rido-service-category-action::after {
        transform: translateX(2px);
    }

    .rido-service-empty {
        background: #fff;
        border: 1px solid rgba(151, 23, 54, .16);
        border-radius: 16px;
        grid-column: 1 / -1;
        padding: 42px;
        text-align: center;
    }

    .rido-service-empty h3 {
        color: #071126;
        font-weight: 650;
    }

    .rido-service-empty p {
        color: #626873;
        margin: 10px 0 0;
    }

    @media (max-width: 991px) {
        .rido-services-page-title {
            min-height: 360px;
            padding: 100px 0 80px;
        }

        .rido-services-page-title .title {
            font-size: 52px;
        }

        .rido-service-intro h2 {
            font-size: 36px;
        }

        .rido-service-catalog {
            padding: 14px 0 78px !important;
        }

        .rido-service-category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575px) {
        .rido-services-page-title {
            min-height: 280px;
            padding: 92px 0 72px;
        }

        .rido-services-page-title .title {
            font-size: 36px;
        }

        .rido-service-catalog {
            padding-top: 12px !important;
        }

        .rido-service-category-grid {
            grid-template-columns: 1fr;
        }

        .rido-service-category-media {
            height: 205px;
        }

        .rido-service-intro h2 {
            font-size: 30px;
        }
    }
</style>
@endpush
