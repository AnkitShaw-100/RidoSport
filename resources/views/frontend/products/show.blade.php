@extends('frontend.layout.main1')

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

<section class="container-fluid py-5" style="background: linear-gradient(135deg, #eef3fa 0%, #f7f9fc 100%);">
    <div class="container">
        <!-- Product Heading -->
        <div class="row mb-4 text-center">
            <div class="col-12">
                <h1 class="font-weight-bold heading-stylish" style="font-size: 3.2rem; color: var(--theme-color1); letter-spacing: 2px; text-transform: uppercase; position: relative;">
                    {{ $product->name }} 
                    <span class="badge badge-primary new-badge" style="font-size: 1rem; background-color:var(--theme-color2)">New</span>
                </h1>
                <div class="underline" style="width: 100px; height: 4px; background: var(--theme-color1); margin: 0 auto;"></div>
            </div>
        </div>

        <!-- Product Section with Animations -->
        <div class="row align-items-center mb-5 interactive-box" style="background: #fff; border-radius: 15px; padding: 30px;">
            <div class="col-lg-6 text-center mb-4 mb-lg-0 slide-in-left">
                <div class="product-image-container" style="position: relative; display: inline-block;">
                    <div class="box-shadow" style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 85%; height: 12px; border-radius: 50%; filter: blur(8px); z-index: -1;"></div>
                    
                    @if(isset($productDetails) && $productDetails->image)
                        <img src="{{ asset($productDetails->image) }}" alt="{{ $product->name }} Product" 
                             style="max-width: 80%; border-radius: 15px; padding: 15px; transition: transform 0.3s ease;" 
                             class="product-image">
                    @else
                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image" 
                             style="max-width: 80%; border-radius: 15px; padding: 15px; transition: transform 0.3s ease;" 
                             class="product-image">
                    @endif
                </div>
            </div>

            <div class="col-lg-6 slide-in-right">
                @if(isset($productDetails) && $productDetails->name)
                    <h2 class="font-weight-bold mb-4 product-heading" style="font-size: 2.5rem; color: var(--theme-color1); text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);">
                        {{ $productDetails->name }}
                    </h2>
                @else
                    <h2 class="font-weight-bold mb-4 product-heading" style="font-size: 2.5rem; color: var(--theme-color1); text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);">
                        New Product
                    </h2>
                @endif

                @if(isset($productDetails) && $productDetails->description)
                    <p class="description-text" style="font-size: 1.8rem; line-height: 1.7; color: #444;">
                        {{ $productDetails->description }}
                    </p>
                @else
                    <p class="description-text" style="font-size: 1.8rem; line-height: 1.7; color: #444;">
                        Not Available
                    </p>
                @endif
            </div>
        </div>

        <!-- Product Details Section with Animation -->
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mb-4 details-heading" style="font-size: 2.2rem; color: #6c757d;">More Details About {{ $pageTitle }}</h3>
                <div class="row">
                    <!-- Technical Details Card -->
                    <div class="col-md-6 mb-4 slide-up">
                        <div class="card h-100 shadow-sm card-hover" style="border-left: 5px solid var(--theme-color1); transition: all 0.3s;">
                            <div class="card-body">
                                <h4 class="card-title card-heading" style="color: var(--theme-color1); font-size: 1.8rem;">Technical Details</h4>
                                <ul class="list-unstyled details-list">
                                    @php
                                        // Check if productDetails exists and has technical_details
                                        $technicalDetails = isset($productDetails->technical_details) 
                                            ? (is_array($productDetails->technical_details) ? $productDetails->technical_details : json_decode($productDetails->technical_details, true)) 
                                            : null;
                                    @endphp

                                    @if($technicalDetails && is_array($technicalDetails))
                                        @foreach($technicalDetails as $detailKey => $detailValue)
                                            <li><strong>{{ ucwords(str_replace('_', ' ', $detailKey)) }}:</strong> {{ $detailValue }}</li>
                                        @endforeach
                                    @else
                                        <li>No technical details available.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Advantages Card -->
                    <div class="col-md-6 mb-4 slide-up">
                        <div class="card h-100 shadow-sm card-hover" style="border-left: 5px solid var(--theme-color1); transition: all 0.3s;">
                            <div class="card-body">
                                <h4 class="card-title card-heading" style="color: var(--theme-color1); font-size: 1.8rem;">Advantages</h4>
                                <ul class="list-unstyled details-list">
                                    @if(isset($productDetails->advantages) && is_array($productDetails->advantages))
                                        @foreach($productDetails->advantages as $advantage)
                                            <li>✔ {{ $advantage }}</li>
                                        @endforeach
                                    @else
                                        <li>No advantages available.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Color Availability Card -->
        <div class="row">
            <div class="col-12">
                <div class="card h-100 shadow-sm card-hover" style="border-left: 5px solid var(--theme-color1); transition: all 0.3s;">
                    <div class="card-body">
                        <h4 class="card-title card-heading " style="color: var(--theme-color1); font-size: 1.8rem; ">Colors Available</h4>
                        <div class="d-flex flex-wrap align-items-center justify-content-center">
                            @if(isset($productDetails->colors) && is_array($productDetails->colors) && count($productDetails->colors) > 0)
                                @php
                                    // Assuming $productDetails->colors is the JSON string you provided.
                                    $colors = json_decode(json_encode($productDetails->colors), true);
                                @endphp
                                @foreach($colors as $color)
                                    <div style="display: flex; flex-direction: column; align-items: center; width: 15%; margin-bottom: 15px;">
                                        <!-- Color Circle -->
                                        <div class="color-sample" style="background-color: {{ $color['value'] }}; width: 45px; height: 45px; border-radius: 50%; margin: 5px; border: 2px solid #fff;" title="{{ $color['key'] }}"></div>
                                        <!-- Color Name -->
                                        <span style="font-size: 1.2rem; text-align: center;">{{ $color['key'] }}</span>
                                    </div>
                                @endforeach                        
                            @else
                                <p>No colors available.</p>
                            @endif
                        </div>
                        
                        <p class="mt-2" style="font-size: 1.4rem;">Available in more colors on request!</p>
                    </div>
                </div>
            </div>
        </div>



        <!-- New Section for "Why Choose?" -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center mb-4 details-heading" style="font-size: 2.2rem; color: var(--theme-color1);">Why Choose {{ $pageTitle }}?</h3>
                <div class="card h-auto shadow-sm card-hover slide-up" style="border-left: 5px solid var(--theme-color1); padding: 20px;">
                    <div class="card-body">
                        <ul class="list-unstyled details-list" style="font-size: 1.6rem; line-height: 2.7;">
                            @if(isset($productDetails->why_choose) && is_array($productDetails->why_choose) && count($productDetails->why_choose) > 0)
                                @php
                                    // Decode the JSON string into an associative array
                                    $whyChooseDetails = json_decode(json_encode($productDetails->why_choose), true);
                                @endphp
                    
                                @foreach($whyChooseDetails as $item)
                                    <li>
                                        ✔ <strong>{{ $item['key'] }}</strong>: {{ $item['value'] }}
                                    </li>
                                @endforeach
                            @else
                                <li>No Why Choose Details available.</li>
                            @endif
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Carousel Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center mb-4 details-heading" style="font-size: 2.2rem; color: var(--theme-color1);">Our {{ $pageTitle }} Products</h3>
                <div id="lightgallery" class="product_list owl-carousel">
                    @php
                        // Decode gallery images
                        $galleryImages = isset($productDetails->gallery_images) ? $productDetails->gallery_images : null;
                        $galleryImagesArray = is_string($galleryImages) ? json_decode(stripslashes($galleryImages), true) : [];
                    @endphp

                    @if(!empty($galleryImagesArray) && is_array($galleryImagesArray))
                        @foreach($galleryImagesArray as $image)
                            <div class="item">
                                <a href="{{ url($image) }}" class="gallery-item">
                                    <img src="{{ url($image) }}" class="carousel-image fixed-size" alt="{{ $product->name }}">
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No gallery images available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Custom Styles with Animations -->
<style>
    .list-unstyled {
        font-size: 1.4rem;
    }

    /* Animations */
    .slide-in-left {
        animation: slideInLeft 1s ease-out;
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .slide-in-right {
        animation: slideInRight 1s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .slide-up {
        animation: slideUp 1s ease-out;
    }

    @keyframes slideUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Carousel item container */
    .productDetails_list .item {
        width: 100%;
        height: 400px; /* Fixed height for laptop screen */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        margin: 0 10px; /* Gap between items */
    }

    /* Responsive image */
    .carousel-image {
        /* max-width: 100%; 
        max-height: 100%;  */
        width: auto; /* Maintain aspect ratio */
        height: 100%; /* Maintain aspect ratio */
        object-fit: cover; /* Ensure image is fully visible without being cut */
        transition: transform 0.3s ease; /* Smooth hover effect */
    }

    /* Ensure the carousel images have a fixed size */
    .fixed-size {
        width: 100%;   /* Set your desired fixed width */
        height: 500px;  /* Set your desired fixed height */
        object-fit: cover; /* Ensure the image covers the area without distortion */
        display: block;
        margin: 0 auto; /* Center the image inside the carousel */
    }

    .product_list .item:hover .carousel-image {
        transform: scale(1.05); /* Slight zoom on hover */
    }

    .carousel-caption{left:0;
        right:0;}
    /* Custom styles for carousel caption */
    .custom-caption {
        text-align: center;
        margin-top: 10px; /* Space between image and caption */
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.9); /* Light background with slight opacity */
        border-radius: 5px; 
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for better emphasis */
        width: 90%; /* Make caption take 90% of the item width */
        margin-left: auto;
        margin-right: auto;
        max-width: 300px; /* Ensure captions don’t get too wide on larger screens */
    }


    /* Caption title styling */
    .caption-title {
        font-size: 1.4rem; /* Adjust as needed */
        font-weight: bold;
        color: var(--theme-color1); /* Apply theme color */
        margin-bottom: 5px;
        text-transform: uppercase; /* Optional: Make the title uppercase */
    }

    /* Caption description styling */
    .caption-description {
        font-size: 1.2rem; /* Match this size as specified */
        color: #555; /* Use a slightly darker color for readability */
        line-height: 1.4; /* Line height for better readability */
        margin: 0; /* Remove default margin */
    }
    /* Ensure carousel is responsive */
    @media (max-width: 1200px) {
        .product_list .item {
            height: 350px; /* Adjust height for smaller screens */
        }
    }

    @media (max-width: 768px) {
        .product_list .item {
            height: 300px; /* Adjust height for tablets */
        }
    }

    @media (max-width: 480px) {
        .product_list .item {
            height: 200px; /* Adjust height for mobile devices */
        }
    }

    /* Custom styles for navigation arrows */
    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel .owl-nav button.owl-next {
        position: absolute;
        top: 50%; /* Center vertically */
        transform: translateY(-50%);
        background-color: var(--theme-color1); /* Apply theme color */
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 50%; /* Rounded arrows */
        cursor: pointer;
        z-index: 1000; /* Ensure arrows are above other elements */
        display: block;
        outline: none;
        transition: background-color 0.3s;
    }

    .owl-carousel .owl-nav button.owl-prev {
        left: -30px; /* Adjust arrow position */
    }

    .owl-carousel .owl-nav button.owl-next {
        right: -30px; /* Adjust arrow position */
    }

    /* Custom styles for navigation dots */
    .owl-carousel .owl-dots .owl-dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        background-color: #ccc;
        margin: 5px;
        border-radius: 50%;
        border: 2px solid var(--theme-color1);
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .owl-carousel .owl-dots .owl-dot.active {
        background-color: var(--theme-color1); /* Active dot color */
    }

    /* Center the dots under the carousel */
    .owl-carousel .owl-dots {
        text-align: center;
        margin-top: 15px;
    }
    /* Zoom container for the hover effect */
    .zoom-container {
        position: relative;
        overflow: hidden;
    }

    /* Image styling */
    .product-image {
        max-width: 80%;
        border-radius: 15px;
        padding: 15px;
        transition: transform 0.3s ease;
    }

    /* Zoom effect on hover */
    .zoom-container:hover .product-image {
        transform: scale(1.5); /* Zoom level on hover */
        cursor: zoom-in; /* Optional: change the cursor to indicate zoom */
    }

    /* Ensure that the overflow stays hidden */
    .zoom-container:hover {
        overflow: hidden;
    }

</style>

    
@endsection
