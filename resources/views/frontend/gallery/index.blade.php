@extends('frontend.layout.main1')

@push('title')
<title>Desan International | Gallery</title>
@endpush

@section('main-section1')

<section class="container-fluid py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h1 class="text-center mb-5" style="font-weight: 700; color: #333;">Our Gallery</h1>
        
        <div class="row justify-content-center">
            {{-- Image Gallery Card --}}
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-images fa-3x" style="color: #007bff;"></i>
                        </div>
                        <h3 class="card-title" style="font-weight: 600;">Image Gallery</h3>
                        <p class="card-text mt-2" style="font-size: 1.1rem;">Total Images: <strong>{{ $images }}</strong></p>
                        <a href="{{route('image-gallery')}}" class="btn btn-outline-primary" style="border-radius: 25px; padding: 10px 20px;">
                            <i class="fas fa-eye mr-2"></i> View Image Gallery
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Video Gallery Card --}}
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-video fa-3x" style="color: #28a745;"></i>
                        </div>
                        <h3 class="card-title" style="font-weight: 600;">Video Gallery</h3>
                        <p class="card-text mt-2" style="font-size: 1.1rem;">Total Videos: <strong>{{ $videos }}</strong></p>
                        <a href="{{route('video-gallery')}}" class="btn btn-outline-success" style="border-radius: 25px; padding: 10px 20px;">
                            <i class="fas fa-eye mr-2"></i> View Video Gallery
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
