@extends('frontend.layout.main1')

@push('title')
<title>Desan International | Products</title>
@endpush

@section('main-section1')
@php
    $formatImageUrl = function ($path) {
        if (empty($path)) {
            return null;
        }

        return preg_match('/^https?:\/\//i', $path) ? $path : asset($path);
    };

@endphp

<section class="page-title rido-products-page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Products</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Products</li>
            </ul>
        </div>
    </div>
</section>

<section class="rido-product-catalog">
    <div class="container">
        <div class="rido-catalog-intro">
            <span class="rido-catalog-kicker">RidoSports Product Range</span>
            <h2>Explore Our Complete Product Catalog</h2>
            <p>Select a product category to open its dedicated detail page.</p>
        </div>

        <div class="rido-category-selector-grid" aria-label="Product categories">
            @foreach($productGroups as $group)
                @php
                    $catalogItems = collect();

                    if ($group->products->isNotEmpty() || $group->subProducts->isEmpty()) {
                        $catalogItems->push($group);
                    }

                    foreach ($group->subProducts as $subProduct) {
                        $catalogItems->push($subProduct);
                    }

                    $categoryDetails = $group->products->first();

                    if (! optional($categoryDetails)->image) {
                        foreach ($group->subProducts as $subProduct) {
                            $categoryDetails = $subProduct->products->first();
                            if (optional($categoryDetails)->image) {
                                break;
                            }
                        }
                    }

                    $categoryImage = $formatImageUrl(optional($categoryDetails)->image);
                    $categoryRoute = $catalogItems->count() > 1
                        ? route('product-category.show', $group->slug)
                        : ($catalogItems->first()->parent_id
                            ? route('subproduct.show', [$group->slug, $catalogItems->first()->slug])
                            : route('product.show', $catalogItems->first()->slug));
                @endphp

                @if($catalogItems->isNotEmpty())
                    <a
                        class="rido-category-selector-card"
                        href="{{ $categoryRoute }}"
                    >
                        <span class="rido-category-selector-media {{ $categoryImage ? '' : 'is-placeholder' }}">
                            @if($categoryImage)
                                <img src="{{ $categoryImage }}" alt="{{ $group->name }}">
                            @else
                                <img src="{{ asset('images/logo/logo-re.png') }}" alt="{{ $group->name }}">
                            @endif
                        </span>
                        <span class="rido-category-selector-content">
                            <span class="rido-category-selector-kicker">Category</span>
                            <strong>{{ $group->name }}</strong>
                            <span class="rido-category-selector-meta">{{ $catalogItems->count() }} {{ $catalogItems->count() === 1 ? 'product' : 'products' }}</span>
                            <span class="rido-category-selector-action">{{ $catalogItems->count() > 1 ? 'View Product Range' : 'View Details' }}</span>
                        </span>
                    </a>
                @endif
            @endforeach

            @if($sportsEquipmentGroups->isNotEmpty())
                @php
                    $equipmentDetails = optional($sportsEquipmentGroups->first())->equipment->first();
                    $equipmentImage = $formatImageUrl(optional($equipmentDetails)->image);
                    $equipmentRoute = $sportsEquipmentGroups->count() > 1
                        ? route('product-category.equipment')
                        : ($sportsEquipmentGroups->first()
                            ? route('equipment.show', ['slug' => $sportsEquipmentGroups->first()->slug])
                            : route('products.index'));
                @endphp
                <a
                    class="rido-category-selector-card"
                    href="{{ $equipmentRoute }}"
                >
                    <span class="rido-category-selector-media {{ $equipmentImage ? '' : 'is-placeholder' }}">
                        @if($equipmentImage)
                            <img src="{{ $equipmentImage }}" alt="Sports Equipments">
                        @else
                            <img src="{{ asset('images/logo/logo-re.png') }}" alt="Sports Equipments">
                        @endif
                    </span>
                    <span class="rido-category-selector-content">
                        <span class="rido-category-selector-kicker">Category</span>
                        <strong>Sports Equipments</strong>
                        <span class="rido-category-selector-meta">{{ $sportsEquipmentGroups->count() }} {{ $sportsEquipmentGroups->count() === 1 ? 'product' : 'products' }}</span>
                        <span class="rido-category-selector-action">{{ $sportsEquipmentGroups->count() > 1 ? 'View Product Range' : 'View Details' }}</span>
                    </span>
                </a>
            @endif
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
        min-height: 430px;
        padding: 120px 0 96px;
    }

    .rido-products-page-title .title-outer {
        color: #fff;
        max-width: 640px;
    }

    .rido-products-page-title .title {
        color: #fff;
        font-size: 68px;
        font-weight: 700;
        line-height: 1.05;
        margin-bottom: 24px;
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

    .rido-product-catalog {
        background: #f7f8fb;
        overflow: hidden;
        padding: 18px 0 100px !important;
        position: relative;
    }

    .rido-product-catalog::before {
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

    .rido-product-catalog .container {
        max-width: 1180px;
        position: relative;
        z-index: 1;
    }

    .rido-category-selector-grid {
        display: grid;
        gap: 22px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin: 0 0 58px;
    }

    .rido-category-selector-card {
        background: linear-gradient(180deg, #ffffff 0%, #fbfcff 100%);
        border: 1px solid rgba(151, 23, 54, .16);
        border-radius: 16px;
        box-shadow: 0 12px 28px rgba(5, 10, 30, .06);
        color: #071126;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        overflow: hidden;
        padding: 0;
        position: relative;
        transition: background .22s ease, border-color .22s ease, box-shadow .22s ease;
    }

    .rido-category-selector-card::before {
        display: none;
    }

    .rido-category-selector-card::after {
        background: radial-gradient(circle at top right, rgba(151, 23, 54, .08), transparent 48%);
        content: "";
        inset: 5px 0 auto auto;
        height: 120px;
        pointer-events: none;
        position: absolute;
        width: 150px;
    }

    .rido-category-selector-card:hover {
        background: #fff;
        border-color: rgba(151, 23, 54, .44);
        box-shadow: 0 18px 38px rgba(5, 10, 30, .1);
        color: #071126;
    }

    .rido-category-selector-card.is-active {
        background: linear-gradient(180deg, #fff7f9 0%, #ffffff 100%);
        border-color: rgba(151, 23, 54, .56);
        box-shadow: inset 0 0 0 1px rgba(151, 23, 54, .1), 0 18px 38px rgba(151, 23, 54, .1);
    }

    .rido-category-selector-media {
        background: #eef1f5;
        display: flex;
        height: 230px;
        overflow: hidden;
        width: 100%;
    }

    .rido-category-selector-media img {
        display: block;
        height: 100%;
        object-fit: cover;
        transition: transform .32s ease;
        width: 100%;
    }

    .rido-category-selector-media.is-placeholder {
        align-items: center;
        background: linear-gradient(135deg, #f7f4f5, #ffffff);
        justify-content: center;
        padding: 35px;
    }

    .rido-category-selector-media.is-placeholder img {
        height: auto;
        max-height: 115px;
        object-fit: contain;
        opacity: .86;
        width: 76%;
    }

    .rido-category-selector-card:hover .rido-category-selector-media img {
        transform: scale(1.035);
    }

    .rido-category-selector-card:hover .rido-category-selector-media.is-placeholder img {
        transform: none;
    }

    .rido-category-selector-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 24px;
    }

    .rido-category-selector-kicker {
        color: var(--theme-color1, #971736);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .08em;
        margin-bottom: 12px;
        position: relative;
        text-transform: uppercase;
        z-index: 1;
    }

    .rido-category-selector-card strong {
        display: block;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 14px;
        position: relative;
        z-index: 1;
    }

    .rido-category-selector-meta {
        color: #626873;
        font-size: 14px;
        margin-bottom: 22px;
        position: relative;
        z-index: 1;
    }

    .rido-category-selector-action {
        align-items: center;
        color: var(--theme-color1, #971736);
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        margin-top: auto;
        position: relative;
        text-transform: uppercase;
        z-index: 1;
    }

    .rido-category-selector-action::after {
        content: ">";
        display: inline-block;
        margin-left: 9px;
        transition: transform .22s ease;
    }

    .rido-category-selector-card:hover .rido-category-selector-action::after {
        transform: translateX(2px);
    }

    .rido-catalog-intro {
        margin: 0 auto 30px;
        max-width: 780px;
        text-align: center;
    }

    .rido-catalog-kicker {
        color: var(--theme-color1, #971736);
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .rido-catalog-intro h2 {
        color: #233e50;
        font-size: 44px;
        font-weight: 700;
        line-height: 1.15;
        margin: 10px 0 14px;
    }

    .rido-catalog-intro p {
        color: #646b78;
        font-size: 17px;
        line-height: 1.75;
        margin: 0;
    }

    .rido-range-panel {
        display: none;
        margin-top: 8px;
    }

    .rido-range-panel.is-active {
        display: block;
    }

    .rido-range-head {
        border-bottom: 1px solid rgba(151, 23, 54, .16);
        margin-bottom: 28px;
        padding-bottom: 18px;
        text-align: left;
    }

    .rido-range-head span,
    .rido-range-card-body span {
        color: var(--theme-color1, #971736);
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .rido-range-head h3 {
        color: #071126;
        font-size: 32px;
        font-weight: 700;
        line-height: 1.25;
        margin: 6px 0 0;
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
        height: 220px;
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

    .rido-range-card-body h4 {
        font-size: 22px;
        font-weight: 700;
        line-height: 1.35;
        margin: 8px 0 14px;
    }

    .rido-range-card-body h4 a {
        color: #071126;
    }

    .rido-range-card-body h4 a:hover {
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

    .rido-catalog-empty {
        background: #fff;
        border: 1px solid rgba(151, 23, 54, .16);
        border-radius: 16px;
        padding: 42px;
        text-align: center;
    }

    .rido-catalog-empty h3 {
        color: #071126;
        font-weight: 650;
    }

    .rido-catalog-empty p {
        color: #626873;
        margin: 10px 0 0;
    }

    @media (max-width: 1199px) {
        .rido-product-catalog .container {
            max-width: 960px;
        }
    }

    @media (max-width: 991px) {
        .rido-products-page-title {
            min-height: 360px;
            padding: 100px 0 80px;
        }

        .rido-products-page-title .title {
            font-size: 52px;
        }

        .rido-catalog-intro h2 {
            font-size: 36px;
        }

        .rido-range-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {
        .rido-products-page-title {
            min-height: 320px;
            padding: 92px 0 72px;
        }

        .rido-products-page-title .title {
            font-size: 42px;
        }

        .rido-product-catalog {
            padding: 14px 0 78px !important;
        }

        .rido-category-selector-grid {
            gap: 18px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-bottom: 42px;
        }

        .rido-category-selector-card {
            min-height: 100%;
        }

        .rido-category-selector-media {
            height: 210px;
        }

        .rido-category-selector-content {
            padding: 22px;
        }

        .rido-range-head h3 {
            font-size: 27px;
        }

        .rido-range-card-media {
            height: 210px;
        }
    }

    @media (max-width: 575px) {
        .rido-products-page-title {
            min-height: 280px;
        }

        .rido-products-page-title .title {
            font-size: 36px;
        }

        .rido-category-selector-grid {
            grid-template-columns: 1fr;
        }

        .rido-category-selector-card {
            min-height: 100%;
        }

        .rido-category-selector-media {
            height: 205px;
        }

        .rido-category-selector-content {
            padding: 20px;
        }

        .rido-catalog-intro h2 {
            font-size: 30px;
        }

        .rido-range-grid {
            grid-template-columns: 1fr;
        }

        .rido-range-card-body {
            padding: 20px;
        }
    }
</style>
@endpush
