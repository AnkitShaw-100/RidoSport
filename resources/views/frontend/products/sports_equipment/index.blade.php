@extends('frontend.layout.main1')

@section('main-section1')
<section class="page-title" style="background:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="auto-container">
        <div class="title-outer" style="color: var(--theme-color1);">
            <h1 class="title" style="color: var(--theme-color1);">{{$pageTitle}}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}" style="color: var(--theme-color1);">Home</a></li>
                <li><a href="{{$pageRoute}}" style="color: var(--theme-color1);">{{$pageTitle}}</a></li>
            </ul>
        </div>
    </div>
</section>
<section class="container-fluid py-5" style="background-color: whitesmoke;">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="display-4 font-weight-bold">{{ $pageTitle }} Equipments</h1>
        </div>

        {{-- Equipment Sections --}}
        <div class="equipment-section mb-5" style="min-height: 80vh;">
            @foreach ($equipments as $index => $equipment)
                <div class="equipment-item">
                    @if ($index % 2 == 0)
                        <div class="equipment-img">
                            <img src="{{ url($equipment->image) }}" 
                                 alt="{{ $equipment->name }} Image" 
                                 class="img-fluid rounded">
                        </div>
                        <div class="equipment-desc">
                            <h1 class="equipment-title">{{ $equipment->name }}</h1>
                            <p class="lead">{{ $equipment->description }}</p>
                        </div>
                    @else
                        <div class="equipment-desc">
                            <h1 class="equipment-title">{{ $equipment->name }}</h1>
                            <p class="lead">{{ $equipment->description }}</p>
                        </div>
                        <div class="equipment-img">
                            <img src="{{ url($equipment->image) }}" 
                                 alt="{{ $equipment->name }} Image" 
                                 class="img-fluid rounded">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('style')
{{-- CSS Styles --}}
<style>
    /* Equipment Section */
    .equipment-section {
        display: grid;
        gap: 20px;
    }

    /* Individual Equipment Item */
    .equipment-item {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: center;
        min-height: 80vh;
    }

    .equipment-img {
        text-align: center;
    }

    .equipment-img img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .equipment-desc {
        padding: 20px;
    }

    .equipment-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: var(--theme-color2);
        margin-bottom: 20px;
    }

    .lead {
        font-size: 2rem;
        line-height: 1.6;
        color: var(--theme-color1);
    }

    /* Medium devices (tablets) */
    @media (max-width: 992px) {
        .lead {
            font-size: 1.5rem;
        }
        .equipment-title {
            font-size: 2rem;
        }
        .equipment-item {
            grid-template-columns: 1fr;
        }
        .equipment-desc {
            text-align: left;
        }
    }

    /* Small devices (landscape phones) */
    @media (max-width: 768px) {
        .lead {
            font-size: 1.3rem;
        }
        .equipment-title {
            font-size: 1.8rem;
        }
    }

    /* Extra small devices (phones) */
    @media (max-width: 576px) {
        .lead {
            font-size: 1.6rem;
        }
        .equipment-title {
            font-size: 1.6rem;
        }
        .equipment-item {
            grid-template-columns: 1fr;
        }
        .equipment-desc {
            text-align: left;
        }
        .equipment-img {
            order: 1;
        }
        .equipment-desc {
            order: 2;
        }
    }
</style>
@endpush
