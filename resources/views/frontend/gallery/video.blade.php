@extends('frontend.layout.main1')

@push('title')
<title>Desan International | Video Gallery</title>
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
        <h1 class="text-center mb-5" style="font-weight: 700; color: #333;">Video Gallery</h1>
        
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow">
                        <div class="embed-responsive" style="padding-bottom: 56.25%;"> <!-- 16:9 Aspect Ratio -->
                            <iframe src="https://www.youtube.com/embed/{{ $video->url }}" 
                                class="embed-responsive-item rounded"  
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $video->caption }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
</section>
<style>
    .card {
    transition: transform 0.2s, box-shadow 0.2s; /* Smooth transitions */
}

.card:hover {
    transform: translateY(-5px); /* Slightly raise card on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* More pronounced shadow on hover */
}

.card-title {
    font-size: 1.4rem; /* Increase font size for captions */
    margin-top: 10px; /* Add margin above title */
}

</style>
@endsection
