<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    @stack('title')
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
    <!-- Include LightGallery CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/navbars/navbar-2/css/navbar-2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/4.0.30/fancybox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
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
        <div class="header-lower-1" style="z-index: 99; background-color: whitesmoke; ">
            <div class="auto-container" style="height:60px">
                <div class="main-box" style="display: flex; justify-content: space-between; align-items: center; ">
                    <!-- Logo box -->
                    <div class="logo-box" style="flex: 1; display: flex; justify-content: start;">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="{{asset('images/logo/logo-re.png')}}" alt="RidoSports" title="RidoSports" style="max-height: 50px;">
                            </a>
                        </div>
                    </div>
                    <!-- Navigation Menu -->
                    <div class="nav-outer" style="flex: 1;">
                        <nav class="main-menu">
                            <ul class="navigation" style="display: flex; gap: 15px;">
                                <li class="current ">
                                    <a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="current"><a href="{{route('about-us')}}">About</a></li>
                                <li class="dropdown"><a href="#" class="dropdown">Products</a>
                                    <ul>
                                        @foreach($products as $product)
                                            @if($product->subproducts->count() > 0)
                                                <li class="dropdown">
                                                    <a href="#">{{ $product->name }}</a>
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
                                            <a href="#">Sports Equipments</a>
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
                                    <a href="#" class="dropdown">Services</a>
                                    <ul>
                                        @foreach($services as $service)
                                            @if($service->subservices->count() > 0)
                                                <li class="dropdown">
                                                    <a href="#">{{ $service->name }}</a>
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
                                    <a href="#">Design Court</a>
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
        
                    <!-- Mobile Nav Toggler -->
                    <div class="outer-box" style=" align-items: center; gap: 10px;">
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
                    <div class="nav-logo"><a href="{{route('home')}}"><img src="{{asset('images/logo/logo-re.png')}}" alt title></a></div>
                    <div class="close-btn"><i class="icon fa fa-times"></i></div>
                </div>
                <ul class="navigation clearfix ">
                </ul>
                <ul class="contact-list-one">
                    <!-- <li>
                        <div class="contact-info-box">
                            <i class="icon lnr-icon-phone-handset"></i>
                            <span class="title">Call Now</span>
                            <a href="tel:+92880098670">+92 (8800) - 98670</a>
                        </div>
                    </li>
                    <li>
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-envelope1"></span>
                            <span class="title">Send Email</span>
                            <a href="/cdn-cgi/l/email-protection#9df5f8f1edddfef2f0edfcf3e4b3fef2f0"><span class="__cf_email__" data-cfemail="0d6568617d4d6e62607d6c6374236e6260">[email&#160;protected]</span></a>
                        </div>
                    </li> -->
                    <!-- <li>
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-clock"></span>
                            <span class="title">Working Hours</span>
                            Mon - Sat 8:00 - 6:30, Sunday - CLOSED
                        </div>
                    </li> -->
                </ul>
                <ul class="social-links">
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </nav>
        </div>

        <div class="sticky-header">
            <div class="auto-container" style="height:60px">
                <div class="inner-container" style="display: flex;
                align-content: flex-end;
                justify-content: space-between;
                align-items: center;">
                    <div class="logo-box" style="flex: 1; display: flex; justify-content: start;">
                        <div class="logo">
                            <a href="{{route('home')}}">
                            <img src="{{asset('images/logo/logo-re.png')}}" alt title="RidoSports" style="max-height: 50px;">
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

    


    
    
