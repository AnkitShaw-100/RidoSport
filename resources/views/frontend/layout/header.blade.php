
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <title>Desan International</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    @stack('meta')

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('css/animated-text.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/slick.css')}}">
    <link href="{{url('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style2.css')}}">
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://www.flaticon.com/uicons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/navbars/navbar-2/css/navbar-2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcVZdIqAAAAAF3KBkE1T-i1lDm95dxmpQQDH6r5" async defer></script>
    <style>
        .phones {
            position: fixed;
            left: 0px;
            bottom: 120px;
            display: flex;
            width: 123px;
            height: 100px;
            align-items: center;
            justify-content: center;
            transition: 0.5s;
            z-index: 99;
        }

        .whatsapp {
            position: fixed;
            left: 33px;
            bottom: 40px;
            display: flex;
            width: 75px;
            height: 50px;
            align-items: center;
            justify-content: center;
            transition: 0.5s;
            z-index: 99;
        }
        .phones img, .whatsapp img {
            display: inline-block;
            max-width: 100%;
            height: auto;
        }

        .phones-img {
        width: 100px;
        height: 150%; /* Ensure height is controlled too */
        object-fit: cover;
        }

        .whatsapp-img {
        width: 100px;
        height: 150%; /* Ensure height is controlled too */
        object-fit: cover;
        }

        .main-header .main-menu .navigation a,
        .mobile-menu .navigation a,
        .main-header .mobile-nav-toggler,
        .mobile-menu .close-btn {
            cursor: pointer;
        }

        .main-header .main-menu .navigation a:focus,
        .main-header .main-menu .navigation a:active,
        .main-header .main-menu .navigation a:focus-visible,
        .mobile-menu .navigation a:focus,
        .mobile-menu .navigation a:active,
        .mobile-menu .navigation a:focus-visible,
        .main-header .mobile-nav-toggler:focus,
        .main-header .mobile-nav-toggler:active,
        .main-header .mobile-nav-toggler:focus-visible,
        .mobile-menu .close-btn:focus,
        .mobile-menu .close-btn:active,
        .mobile-menu .close-btn:focus-visible {
            border-color: transparent !important;
            box-shadow: none !important;
            outline: 0 !important;
            text-decoration: none !important;
        }

        .main-header .main-menu .navigation > li > a {
            position: relative;
        }

        .main-header .main-menu .navigation > li > a::after {
            background: var(--theme-color1, #971736);
            bottom: -7px;
            content: "";
            height: 2px;
            left: 50%;
            position: absolute;
            transform: translateX(-50%) scaleX(0);
            transform-origin: center center;
            transition: transform 220ms ease;
            width: 100%;
        }

        .main-header .main-menu .navigation > li > a:hover,
        .main-header .main-menu .navigation > li > a:active,
        .main-header .main-menu .navigation > li > a:focus-visible {
            background: transparent !important;
            color: var(--theme-color1, #971736) !important;
        }

        .main-header .main-menu .navigation > li > a:hover::after,
        .main-header .main-menu .navigation > li > a:active::after,
        .main-header .main-menu .navigation > li > a:focus-visible::after {
            transform: translateX(-50%) scaleX(1);
        }

        .main-header .main-menu .navigation ul a:focus,
        .main-header .main-menu .navigation ul a:active,
        .main-header .main-menu .navigation ul a:focus-visible,
        .mobile-menu .navigation a:focus,
        .mobile-menu .navigation a:active,
        .mobile-menu .navigation a:focus-visible {
            background: transparent !important;
            color: var(--theme-color1, #971736) !important;
        }

        a,
        button,
        input[type="button"],
        input[type="submit"],
        input[type="reset"],
        .btn,
        [role="button"],
        [tabindex] {
            -webkit-tap-highlight-color: transparent;
        }

        a:focus,
        a:active,
        a:focus-visible,
        button:focus,
        button:active,
        button:focus-visible,
        input[type="button"]:focus,
        input[type="button"]:active,
        input[type="button"]:focus-visible,
        input[type="submit"]:focus,
        input[type="submit"]:active,
        input[type="submit"]:focus-visible,
        input[type="reset"]:focus,
        input[type="reset"]:active,
        input[type="reset"]:focus-visible,
        .btn:focus,
        .btn:active,
        .btn:focus-visible,
        [role="button"]:focus,
        [role="button"]:active,
        [role="button"]:focus-visible,
        [tabindex]:focus,
        [tabindex]:active,
        [tabindex]:focus-visible {
            outline: 0 !important;
            text-decoration: none !important;
        }

        button:focus,
        button:active,
        input[type="button"]:focus,
        input[type="button"]:active,
        input[type="submit"]:focus,
        input[type="submit"]:active,
        input[type="reset"]:focus,
        input[type="reset"]:active,
        .btn:focus,
        .btn:active,
        .btn:focus-visible {
            box-shadow: none !important;
        }

        button::-moz-focus-inner,
        input::-moz-focus-inner {
            border: 0 !important;
        }
    </style>
    @stack('style')
    @stack('gtag')
    @stack('pixel_tag')
    
</head>
<body>
<div class="page-wrapper">
    <div class="preloader">
        <img src="/images/logo/logo-re.png" alt="Loading...">
    </div>
    
    <header class="main-header header-style-one">
        <!-- Original Header -->
        <div class="header-lower" style="z-index: 99; background-color: transparent;">
            <div class="auto-container" style="height:60px">
                <div class="main-box" style="display: flex; align-content: flex-end; justify-content: space-between; align-items: center;">
                    <!-- Logo Centered -->
                    <div class="logo-box" style="flex: 1; display: flex; justify-content: center;">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="{{url('images/logo/logo-re.png')}}" alt title="Tronis" style="max-height: 50px;">
                            </a>
                        </div>
                    </div>

                    <!-- Bars and Other Elements Aligned Right -->
                    <div class="nav-outer" style="display: none;">
                        <nav class="nav main-menu">
                            <ul class="navigation ">
                                <li class="current "><a href="{{route('home')}}">Home</a></li>
                                <li class="current"><a href="{{route('about-us')}}">About</a></li>
                                <li class="dropdown"><a href="{{ route('products.index') }}" class="dropdown">Products</a>
                                    <ul>
                                        @foreach($products as $product)
                                        @if($product->subproducts->count() > 0)
                                            <li class="dropdown">
                                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                                <ul>
                                                    @foreach($product->subproducts as $subproduct)
                                                        <li>
                                                            <a href="{{ route('subproduct.show', [$product->slug, $subproduct->slug]) }}">
                                                                {{ $subproduct->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                        <li class="dropdown">
                                            <a href="{{ route('products.index') }}">Sports Equipments</a>
                                            <ul>
                                                @foreach($sports_equipment_list as $equipment)
                                                    <li>
                                                        <a class="dropdown" href="{{ route('equipment.show', ['slug' => $equipment->slug]) }}">
                                                            {{ $equipment->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('services.index') }}" class="dropdown">Services</a>
                                    <ul>
                                        @foreach($services as $service)
                                            @if($service->subservices->count() > 0)
                                                <li class="dropdown">
                                                    <a href="{{ route('service-category.show', $service->slug) }}">{{ $service->name }}</a>
                                                    <ul>
                                                        @foreach($service->subservices as $subservice)
                                                            <li>
                                                                <a href="{{ route('subservice.show', [$service->slug, $subservice->slug]) }}">
                                                                    {{ $subservice->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('service.show', $service->slug) }}">{{ $service->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                
                                <li class="dropdown">
                                    <a href="{{ route('design-court') }}">Design Court</a>
                                    <ul>
                                        <li><a href="{{ route('basketball-court') }}">Basketball Court</a></li>
                                        <li><a href="{{ route('handball-court') }}">Handball Court</a></li>
                                        <li><a href="{{ route('badminton-court') }}">Badminton Court</a></li>
                                        <li><a href="{{ route('tennis-court') }}">Tennis Court</a></li>
                                        <li><a href="{{ route('futsal-court') }}">Futsal Court</a></li>
                                        <li><a href="{{ route('volleyball-court') }}">Volleyball Court</a></li>
										
                                       <li><a href="{{ route('pickle-ball-court') }}">Pickle-Ball Court</a></li>

                                        <li><a href="{{ route('padel-court') }}">Padel Court</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#">More</a>
                                    <ul>
                                        <li><a href="{{route('blog')}}">Blogs</a></li>
                                        <li><a href="{{route('image-gallery')}}">Image Gallery</a></li>
                                        <li><a href="{{route('video-gallery')}}">Video Gallery</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('contact-us')}}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="outer-box" style="display: flex; align-items: center; gap: 10px;">
                        <div class="mobile-nav-toggler">
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="upper-box">
                <div class="nav-logo"><a href="{{route('home')}}">
                    <img src="{{url('images/logo/logo-re.png')}}" alt title>
                </a></div>
                <div class="close-btn"><i class="icon fa fa-times"></i></div>
            </div>
            <ul class="navigation clearfix ">
                
            </ul>
            <ul class="contact-list-one">

            </ul>
            <ul class="social-links">
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </nav>
    </div>
    
    <!-- Sticky-Header Menu -->
    <div class="sticky-header">
        <div class="auto-container" style="height:60px">
        <div class="inner-container" style="display: flex;
        align-content: flex-end;
        justify-content: space-between;
        align-items: center;">
            <div class="logo-box" style="flex: 1; display: flex; justify-content: start;">
            <div class="logo">
                <a href="{{route('home')}}">
                    <img src="{{url('images/logo/logo-re.png')}}" alt title="Tronis" style="max-height: 50px;">
                    <!-- <img src="{{url('images/logo/logo-re.png')}}" alt title="Tronis" style="max-height: 50px;"> -->
                </a>
            </div>
            </div>
        
        <div class="nav-outer">
            <nav class="main-menu">
            <div class="navbar-collapse show collapse clearfix">
                <ul class="navigation">
                
                </ul>
            </div>
            </nav>
        </div>

        <div class="outer-box">

            <div class="mobile-nav-toggler">
            <i class="fa fa-bars"></i>
            </div>
        </div>

        </div>
        </div>
    </div>
    </header>

