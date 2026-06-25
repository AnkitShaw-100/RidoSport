{{-- <div class="testimonial-area" style="background: url('images/bg/sky-bg.png'); background-repeat: no-repeat; background-position: center; background-size: cover; background-color: whitesmoke;">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="section-title text-center">
                    <h1 class="section-main-title"> <span>TESTIMONIALS</span></h1>
                </div>
            </div>
            <div class="row">
                <div class="testi_list owl-carousel">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-lg-12 col-md-12">
                            <div class="testi-box">
                                <div class="testi-single-box" style="min-height: 300px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div class="testi-icon">
                                        <img src="{{ asset('images/icons/testi1.png') }}" style="width:50px;" alt="testi1">
                                    </div>
                                    <div class="testi-content" style="flex-grow: 1;">
                                        <p class="testi-text">{{ $testimonial->message }}</p>
                                        <ul class="testi-rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <h3 class="testi-title">{{ $testimonial->author_name }} <br><span>{{ $testimonial->author_designation }}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> --}}

<style>
    /* Importing fonts from Google */
    @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;600&display=swap');

    /* Variables for theme colors */
    :root {
        --theme-color1: #971736; /* Dark red */
        --theme-color11: #233e50; /* Dark teal */
    }

    /* Testimonial Section Styling */
    .testimonial-area {
        margin: 0;
        padding: 120px 0;
        background: url('images/bg/sky-bg.png') no-repeat center center !important;
        background-size: cover !important;
        background-color: whitesmoke !important;
    }

    /* Main container setup */
    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    /* Card setup */
    .card {
        width: min(350px, calc(100% - 20px));
        height: 500px;
        position: relative;
        transform-style: preserve-3d;
        perspective: 500px;
        border: none;
        transition: transform 0.5s;
        background-color: transparent;
        margin: 20px auto;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card .face {
        position: absolute;
        width: 100%;
        height: 100%;
        box-shadow: none;
        border: 1px solid rgba(151, 23, 54, .28);
        border-radius: 15px;
        box-sizing: border-box;
        backface-visibility: hidden;
        transition: transform 0.5s;
        overflow: hidden;
    }

    /* Front face */
    .card .face.front-face {
        background: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .card .face.front-face .profile {
        width: 100%;
        height: 350px;
        background-size: cover;
        background-position: center;
        border-radius: 15px 15px 0 0;
    }

    .card .face.front-face .details {
        width: 100%;
        height: 150px;
        background-color: beige;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 0 0 15px 15px;
        text-align: center;
        padding: 10px;
    }

    .card .face.front-face .name {
        font-family: "Fira Sans", sans-serif;
        font-size: 18px;
        color: var(--theme-color11);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card .face.front-face .designation {
        font-size: 14px;
        color: var(--theme-color1);
        letter-spacing: 0.5px;
    }

    /* Back face */
    .card .face.back-face {
        background: var(--theme-color1);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transform: rotateY(180deg);
        padding: 20px;
        text-align: center;
    }

    .card .face.back-face .testimonial {
        font-family: "Fira Sans";
        font-size: 20px;
        font-weight: 800;
        color: #fff;
        line-height: 1.5;
        margin: 10px 0;
    }

    .card .face.back-face .fa-quote-left,
    .card .face.back-face .fa-quote-right {
        color: #fff;
        font-size: 1.5rem;
    }

    /* Rotate card on hover */
    .card:hover .face.front-face {
        transform: rotateY(180deg);
    }

    .card:hover .face.back-face {
        transform: rotateY(360deg);
    }

    /* Responsive Fixes */
    @media (max-width: 991px) {
        .card-container {
            flex-direction: column;
            align-items: center;
        }

        .card {
            max-width: 100%;
            margin: 20px;
        }
    }

    @media (max-width: 768px) {
        .card .face.front-face .details .name {
            font-size: 16px;
        }

        .card .face.front-face .details .designation {
            font-size: 12px;
        }

        .card .face.back-face .testimonial {
            font-size: 16px;
        }
    }

    .testimonial-area .testi_list {
        padding: 0;
        position: relative;
    }

    .testimonial-area .testi_list .owl-stage {
        align-items: stretch;
        display: flex;
    }

    .testimonial-area .testi_list .owl-item {
        display: flex;
        justify-content: center;
    }

    .testimonial-area .testi_list .col-lg-12 {
        display: flex;
        justify-content: center;
        padding-left: 0;
        padding-right: 0;
        width: 100%;
    }

    .testimonial-area .testi_list .owl-nav {
        display: block !important;
        margin: 0;
    }

    .testimonial-area .testi_list .owl-prev,
    .testimonial-area .testi_list .owl-next {
        align-items: center;
        background: #fff !important;
        border: 1px solid rgba(151, 23, 54, .34) !important;
        border-radius: 50% !important;
        box-shadow: none;
        color: var(--theme-color1) !important;
        display: flex !important;
        font-size: 24px;
        font-weight: 700;
        height: 44px;
        justify-content: center;
        line-height: 1;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        transition: background .25s ease, color .25s ease;
        width: 44px;
        z-index: 5;
    }

    .testimonial-area .testi_list .owl-prev {
        left: -56px;
    }

    .testimonial-area .testi_list .owl-next {
        right: -56px;
    }

    .testimonial-area .testi_list .owl-prev:hover,
    .testimonial-area .testi_list .owl-next:hover {
        background: var(--theme-color1) !important;
        color: #fff !important;
    }

    .testimonial-area .testi_list .owl-prev span,
    .testimonial-area .testi_list .owl-next span {
        display: block;
        line-height: 1;
        margin-top: -2px;
    }

    @media (max-width: 767px) {
        .testimonial-area .testi_list {
            padding: 0 40px;
        }

        .testimonial-area .testi_list .owl-prev,
        .testimonial-area .testi_list .owl-next {
            height: 38px;
            width: 38px;
        }
    }
</style>

<div class="testimonial-area">
    <div class="container">
        <div class="section-title text-center">
            <h1 class="section-main-title"><span>TESTIMONIALS</span></h1>
        </div>
        <div class="row">
            @php
                $testimonialSource = collect($testimonials);
                $testimonialItems = $testimonialSource;

                while ($testimonialSource->isNotEmpty() && $testimonialItems->count() < 6) {
                    $testimonialItems = $testimonialItems->concat($testimonialSource);
                }
            @endphp
            <div class="testi_list owl-carousel">
                @foreach ($testimonialItems as $testimonial)
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Front face -->
                        <div class="face front-face">
                            <div class="profile" style="background-image: url('{{ asset($testimonial->author_image) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>


                            <div class="details">
                                <div class="name">{{ $testimonial->author_name }}</div>
                                <div class="designation">{{ $testimonial->author_designation }}</div>
                            </div>
                        </div>
                        <!-- Back face -->
                        <div class="face back-face">
                            <span class="fas fa-quote-left"></span>
                            <div class="testimonial">
                                {{ $testimonial->message }}
                            </div>
                            <span class="fas fa-quote-right"></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.jQuery || !jQuery.fn.owlCarousel) {
                return;
            }

            var $carousel = jQuery('.testimonial-area .testi_list');

            if (!$carousel.length) {
                return;
            }

            if ($carousel.data('owl.carousel')) {
                $carousel.trigger('destroy.owl.carousel');
                $carousel.removeClass('owl-loaded owl-drag');
                $carousel.find('.owl-stage-outer').children().unwrap();
            }

            $carousel.owlCarousel({
                autoplay: true,
                autoplayHoverPause: false,
                autoplayTimeout: 2200,
                dots: false,
                loop: true,
                margin: 30,
                nav: true,
                navText: ["<span>&lsaquo;</span>", "<span>&rsaquo;</span>"],
                slideBy: 1,
                smartSpeed: 900,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
@endpush
