@extends('frontend.layout.main1')

@push('title')
<title>Desan International | Image Gallery</title>
@endpush

@section('main-section1')
<section class="page-title" style="background:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="auto-container">
        <div class="title-outer" style="color: var(--theme-color1);">
            <h1 class="title" style="color: var(--theme-color1);">{{ $pageTitle }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}" style="color: var(--theme-color1);">Home</a></li>
                <li><a href="{{ $pageRoute }}" style="color: var(--theme-color1);">{{ $pageTitle }}</a></li>
            </ul>
        </div>
    </div>
</section>
<section class="container-fluid py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h1 class="text-center mb-5" style="font-weight: 700; color: #333;">Image Gallery</h1>
        
        <div class="row">
            @foreach($images as $image)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($image->image_path) }}" class="card-img-top" alt="{{ $image->title }}" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center font-bold">
                            <h5 class="card-title">{{ $image->caption }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
</section>
@push('style')
<style>
    .card {
        border: none; /* Remove border */
        transition: transform 0.2s; /* Animation for hover effect */
    }

    .card:hover {
        transform: scale(1.05); /* Slightly enlarge card on hover */
    }

    .card-img-top {
        border-radius: 5px; /* Add some rounding to image corners */
    }

    .card-title {
        font-size: 1.5rem; /* Increase font size for better visibility */
        margin-top: 10px; /* Add margin above title */
    }

</style>
@endpush
@push('script')

@endpush

@endsection
