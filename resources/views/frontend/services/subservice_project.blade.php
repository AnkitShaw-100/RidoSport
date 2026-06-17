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
            <h1 class="display-4 font-weight-bold">{{$pageTitle}}</h1>
        </div>
        <div class="service-section mb-5" style="min-height: 80vh;">
            @forelse($projects as $project)
                <div class="service-item">
                    @php
                        $images = json_decode($project->images, true);
                        $isLeft = $loop->index % 2 === 0; // True if even index (0, 2, 4...), false if odd (1, 3, 5...)
                    @endphp

                    @if($isLeft)
                        <div class="service-img gallery_service">
                            <div id="carouselExample{{$loop->index}}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($images as $index => $image)
                                        <a href="{{ url($image) }}" class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ url($image) }}" 
                                                 alt="{{ $project->title }} Service Image" class="img-fluid rounded" style="object-fit: cover; width: 100%;">
                                        </a>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{$loop->index}}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{$loop->index}}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="service-desc">
                            <h1 class="service-title">{{ $project->title }}</h1>
                            <p class="lead">{{ $project->description }}</p>
                        </div>
                    @else
                        <div class="service-desc">
                            <h1 class="service-title">{{ $project->title }}</h1>
                            <p class="lead">{{ $project->description }}</p>
                        </div>
                        <div class="service-img gallery_service">
                            <div id="carouselExample{{$loop->index}}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($images as $index => $image)
                                        <a href="{{ url($image) }}" class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ url($image) }}" 
                                                 alt="{{ $project->title }} Service Image" class="img-fluid rounded" style="object-fit: cover; width: 100%;">
                                        </a>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{$loop->index}}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{$loop->index}}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <p>No projects available for this sub-service.</p>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="pagination-wrapper">
            {{ $projects->links('pagination::bootstrap-4') }} <!-- Bootstrap pagination style -->
        </div>
    </div>
</section>

@endsection



@push('style')
    {{-- CSS Styles --}}
    <style>
        /* Service Section */
        .service-section {
            display: grid;
            gap: 20px;
        }

        /* Individual Service Item */
        .service-item {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: center;
            min-height: 80vh;
        }

        .service-img {
            text-align: center;
            position: relative;
        }

        .service-img img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .carousel-inner {
            /* border: 4px solid white;  */
            border-radius: 10px; /* Adjust the border radius for rounded corners */
            overflow: hidden; /* Ensure the border and shadow don't overflow */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Adds shadow for 3D effect */
        }

        .carousel-item img {
            transition: transform 0.3s ease; /* Smooth zoom effect on hover */
        }

        .carousel-item:hover img {
            transform: scale(1.05); /* Slightly zooms the image on hover */
        }

        /* Add some spacing between the carousel and the text */
        .service-item {
            margin-bottom: 30px; /* Adjust as necessary */
        }
        .service-desc {
            padding: 20px;
        }

        .service-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--theme-color2);
            margin-bottom: 20px;
        }

        .lead {
            font-size: 2rem;
            line-height: 1.6;
            font-weight: 500;
            color: var(--theme-color1);
        }

        /* Medium devices (tablets) */
        @media (max-width: 992px) {
            .lead {
                font-size: 1.5rem;
            }
            .service-title {
                font-size: 2rem;
            }
            .service-item {
                grid-template-columns: 1fr;
            }
            .service-desc {
                text-align: left;
            }
        }

        /* Small devices (landscape phones) */
        @media (max-width: 768px) {
            .lead {
                font-size: 1.3rem;
            }
            .service-title {
                font-size: 1.8rem;
            }
        }

        /* Extra small devices (phones) */
        @media (max-width: 576px) {
            .lead {
                font-size: 1.6rem;
            }
            .service-title {
                font-size: 1.6rem;
            }
            .service-item {
                grid-template-columns: 1fr;
            }
            .service-desc {
                text-align: left;
            }
            .service-img {
                order: 1;
            }
            .service-desc {
                order: 2;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize LightGallery for elements with the class "gallery_service"
            const galleries = document.querySelectorAll('.gallery_service');
            galleries.forEach(gallery => {
                lightGallery(gallery, {
                    selector: 'a'
                });
            });
        });
    </script>
@endpush