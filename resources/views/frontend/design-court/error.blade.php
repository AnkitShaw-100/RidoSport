@extends('frontend.layout.main1')

@push('title')
<title>Rido Sports | Design Court</title>
@endpush

@section('main-section1')
@php
    $courts = [
        [
            'name' => 'Basketball Court',
            'size' => '32 X 19 M',
            'play_area' => '28 X 15 M play area',
            'image' => 'court-design/layouts/basketball.jpg',
            'route' => route('basketball-court'),
        ],
        [
            'name' => 'Handball Court',
            'size' => '40 X 20 M',
            'play_area' => 'Professional court layout',
            'image' => 'court-design/layouts/handball.jpg',
            'route' => route('handball-court'),
        ],
        [
            'name' => 'Badminton Court',
            'size' => '44 X 20 Ft',
            'play_area' => 'Single and double court layout',
            'image' => 'court-design/layouts/badminton.jpg',
            'route' => route('badminton-court'),
        ],
        [
            'name' => 'Tennis Court',
            'size' => '78 X 36 Ft',
            'play_area' => 'Tournament-ready layout',
            'image' => 'court-design/layouts/tennis.jpg',
            'route' => route('tennis-court'),
        ],
        [
            'name' => 'Futsal Court',
            'size' => '31 X 16 M',
            'play_area' => 'Compact football layout',
            'image' => 'court-design/assets/img/thumb_futsal_bigger.png',
            'route' => route('futsal-court'),
        ],
        [
            'name' => 'Volleyball Court',
            'size' => '18 X 9 M',
            'play_area' => 'Indoor and outdoor layout',
            'image' => 'court-design/layouts/volleyball.jpg',
            'route' => route('volleyball-court'),
        ],
        [
            'name' => 'Pickle-Ball Court',
            'size' => '44 X 20 Ft',
            'play_area' => 'Recreational and club layout',
            'image' => 'court-design/layouts/pickle-ball.jpg',
            'route' => route('pickle-ball-court'),
        ],
        [
            'name' => 'Padel Court',
            'size' => '20 X 10 M',
            'play_area' => 'Premium padel layout',
            'image' => 'court-design/layouts/padel.jpg',
            'route' => route('padel-court'),
        ],
    ];
@endphp

<section class="page-title rido-court-page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Design Court</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Design Court</li>
            </ul>
        </div>
    </div>
</section>

<section class="rido-court-catalog">
    <div class="container">
        <div class="rido-court-intro">
            <span class="rido-court-kicker">RidoSports Court Designer</span>
            <h2>Choose a Court Layout to Customize</h2>
            <p>Select a court type below to open its dedicated designer with color selection and downloadable layout options.</p>
        </div>

        <div class="rido-court-grid" aria-label="Court design options">
            @foreach($courts as $court)
                <a class="rido-court-card" href="{{ $court['route'] }}">
                    <span class="rido-court-media">
                        <img src="{{ asset($court['image']) }}" alt="{{ $court['name'] }}">
                    </span>
                    <span class="rido-court-content">
                        <span class="rido-court-card-kicker">Court Category</span>
                        <strong>{{ $court['name'] }}</strong>
                        <span class="rido-court-meta">{{ $court['size'] }}</span>
                        <span class="rido-court-action">Open Designer</span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
    .rido-court-page-title {
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

    .rido-court-page-title .title-outer {
        color: #fff;
        max-width: 680px;
    }

    .rido-court-page-title .title {
        color: #fff;
        font-size: 68px;
        font-weight: 700;
        line-height: 1.05;
        margin-bottom: 24px;
        text-shadow: 0 14px 28px rgba(0, 0, 0, .28);
    }

    .rido-court-page-title .page-breadcrumb {
        background: rgba(151, 23, 54, .84);
        border-radius: 2px;
        display: inline-flex;
        gap: 10px;
        padding: 11px 16px;
    }

    .rido-court-page-title .page-breadcrumb,
    .rido-court-page-title .page-breadcrumb a,
    .rido-court-page-title .page-breadcrumb li {
        color: #fff;
    }

    .rido-court-catalog {
        background: #f7f8fb;
        overflow: hidden;
        padding: 18px 0 100px !important;
        position: relative;
    }

    .rido-court-catalog::before {
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

    .rido-court-catalog .container {
        max-width: 1180px;
        position: relative;
        z-index: 1;
    }

    .rido-court-intro {
        margin: 0 auto 30px;
        max-width: 820px;
        text-align: center;
    }

    .rido-court-kicker {
        color: var(--theme-color1, #971736);
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .rido-court-intro h2 {
        color: #233e50;
        font-size: 44px;
        font-weight: 700;
        line-height: 1.15;
        margin: 10px 0 14px;
    }

    .rido-court-intro p {
        color: #646b78;
        font-size: 17px;
        line-height: 1.75;
        margin: 0;
    }

    .rido-court-grid {
        display: grid;
        gap: 22px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .rido-court-card {
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

    .rido-court-card::after {
        background: radial-gradient(circle at top right, rgba(151, 23, 54, .08), transparent 48%);
        content: "";
        height: 120px;
        inset: 5px 0 auto auto;
        pointer-events: none;
        position: absolute;
        width: 150px;
    }

    .rido-court-card:hover {
        background: #fff;
        border-color: rgba(151, 23, 54, .44);
        box-shadow: 0 18px 38px rgba(5, 10, 30, .1);
        color: #071126;
    }

    .rido-court-media {
        background: #eef1f5;
        display: flex;
        height: 230px;
        overflow: hidden;
        width: 100%;
    }

    .rido-court-media img {
        display: block;
        height: 100%;
        object-fit: cover;
        transition: transform .32s ease;
        width: 100%;
    }

    .rido-court-card:hover .rido-court-media img {
        transform: scale(1.035);
    }

    .rido-court-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 24px;
    }

    .rido-court-card-kicker {
        color: var(--theme-color1, #971736);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .08em;
        margin-bottom: 12px;
        position: relative;
        text-transform: uppercase;
        z-index: 1;
    }

    .rido-court-card strong {
        display: block;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 14px;
        position: relative;
        z-index: 1;
    }

    .rido-court-meta {
        color: #626873;
        font-size: 14px;
        margin-bottom: 22px;
        position: relative;
        z-index: 1;
    }

    .rido-court-action {
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

    .rido-court-action::after {
        content: ">";
        display: inline-block;
        margin-left: 9px;
        transition: transform .22s ease;
    }

    .rido-court-card:hover .rido-court-action::after {
        transform: translateX(2px);
    }

    @media (max-width: 991px) {
        .rido-court-page-title {
            min-height: 360px;
            padding: 100px 0 80px;
        }

        .rido-court-page-title .title {
            font-size: 52px;
        }

        .rido-court-intro h2 {
            font-size: 36px;
        }

        .rido-court-catalog {
            padding: 14px 0 78px !important;
        }

        .rido-court-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575px) {
        .rido-court-page-title {
            min-height: 280px;
            padding: 92px 0 72px;
        }

        .rido-court-page-title .title {
            font-size: 36px;
        }

        .rido-court-intro h2 {
            font-size: 30px;
        }

        .rido-court-catalog {
            padding-top: 12px !important;
        }

        .rido-court-grid {
            grid-template-columns: 1fr;
        }

        .rido-court-media {
            height: 205px;
        }
    }
</style>
@endpush
