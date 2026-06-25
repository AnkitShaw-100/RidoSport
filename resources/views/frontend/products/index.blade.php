<!-- resources/views/products/index.blade.php -->
<div class="project-area style-two rido-premium-products-section" style="background: url('images/bg/pproject.png') !important; background-repeat: no-repeat; background-position: center center; background-size: cover;">
    <div class="container-fluid rido-premium-products-container">
        <div class="row project align-items-center">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h1 class="section-main-title rido-premium-heading" style="text-transform: uppercase"><span class="rido-premium-heading-nowrap">Enhance your game with our</span> <span>Premium Products</span></h1>
                </div>
            </div>
        </div>
        <div class="row carousel">
            <div class="project_list owl-carousel rido-premium-products-carousel">
                @foreach($product_cards as $productCard)
                    <div class="rido-premium-products-item">
                        <div class="project-single-box">
                            <div class="project-thumb">
                                <img src="{{ asset($productCard->product_card_image) }}" alt="{{ $productCard->product_card_title }}">
                            </div>
                            <div class="project-content">
                                <h3 class="project-title"><a href="#">{{ $productCard->product_card_title }}</a></h3>
                                @php
                                    $productDescription = trim(strip_tags($productCard->product_card_description));
                                    $productDescription = strlen($productDescription) > 300 ? substr($productDescription, 0, 300) . '...' : $productDescription;
                                @endphp
                                <p class="project-text">{{ $productDescription }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="row project align-items-center">
            <div class="col-lg-12">
                <div class="project">
                    <div class="rido-btn" style="display: flex; justify-content: center; align-items: center;">
                        <a href='#' style="display: inline-block; position: relative; color: white; font-weight: bold; text-align: center;">
                            VIEW ALL PRODUCTS
                            <div class="rido-hover-btn hover-bx"></div>
                            <div class="rido-hover-btn hover-bx2"></div>
                            <div class="rido-hover-btn hover-bx3"></div>
                            <div class="rido-hover-btn hover-bx4"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<style>
    .rido-premium-products-section {
        overflow: hidden;
        padding-bottom: 82px !important;
    }

    .rido-premium-products-section .rido-premium-products-container {
        max-width: 1365px;
        padding-left: 15px;
        padding-right: 15px;
    }

    .rido-premium-products-section .row.project {
        justify-content: center;
        padding: 0 15px 0;
        text-align: center;
    }

    .rido-premium-products-section .section-title.text-left {
        margin-bottom: 44px;
        text-align: center !important;
        width: 100%;
    }

    .rido-premium-products-section .rido-premium-heading {
        color: #233e50;
        text-align: center !important;
    }

    .rido-premium-products-section .rido-premium-heading-nowrap {
        color: #233e50 !important;
        display: inline-block;
        white-space: nowrap;
    }

    .rido-premium-products-section .row.carousel {
        padding: 0 58px;
        position: relative;
    }

    .rido-premium-products-section .project-single-box {
        background: #171a2b;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 20px;
        box-shadow: none;
        display: flex;
        flex-direction: column;
        height: 100%;
        margin-bottom: 0;
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }

    .rido-premium-products-section .project-single-box:hover {
        border-color: rgba(151, 23, 54, .48);
        box-shadow: none;
        transform: translateY(-8px);
    }

    .rido-premium-products-section .project-thumb {
        background: #171a2b;
        overflow: hidden;
        padding: 0;
    }

    .rido-premium-products-section .project-thumb img {
        border-radius: 20px 20px 0 0;
        display: block;
        height: 270px;
        object-fit: cover;
        transition: transform .35s ease;
        width: 100%;
    }

    .rido-premium-products-section .project-single-box:hover .project-thumb img {
        transform: scale(1.035);
    }

    .rido-premium-products-section .project-content {
        background: #171a2b;
        border-radius: 0;
        display: flex;
        flex: 1;
        flex-direction: column;
        height: auto;
        justify-content: flex-start;
        min-height: 280px;
        padding: 0;
        text-align: center;
    }

    .rido-premium-products-section h3.project-title {
        align-items: center;
        display: flex;
        justify-content: center;
        line-height: 1.3;
        margin: 0;
        min-height: 76px;
        padding: 14px 24px;
    }

    .rido-premium-products-section h3.project-title a {
        color: #fff;
        display: -webkit-box;
        font-size: 22px;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 0;
        min-height: auto;
        overflow: hidden;
        overflow-wrap: anywhere;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .rido-premium-products-section h3.project-title a:hover {
        color: #fff;
    }

    .rido-premium-products-section p.project-text {
        background: var(--theme-color1, #971736);
        color: #fff;
        cursor: default;
        display: -webkit-box;
        flex: 1 1 auto;
        font-size: 16px;
        line-height: 1.65;
        margin: 0;
        min-height: 0;
        overflow: hidden;
        padding: 14px 26px 24px;
        text-align: center;
        text-transform: none;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 6;
    }

    .rido-premium-products-section p.project-text::before {
        display: none;
    }

    .rido-premium-products-section .owl-stage {
        display: flex;
    }

    .rido-premium-products-section .owl-item {
        display: flex;
    }

    .rido-premium-products-section .rido-premium-products-item {
        display: flex;
        height: 100%;
        width: 100%;
    }

    .rido-premium-products-section .owl-nav {
        display: block !important;
        margin: 0;
    }

    .rido-premium-products-section .owl-prev,
    .rido-premium-products-section .owl-next {
        align-items: center;
        background: #fff !important;
        border: 1px solid rgba(151, 23, 54, .34) !important;
        border-radius: 50% !important;
        box-shadow: 0 10px 22px rgba(5, 10, 30, .15);
        color: var(--theme-color1) !important;
        display: flex !important;
        font-size: 24px;
        font-weight: 700;
        height: 44px;
        justify-content: center;
        position: absolute;
        line-height: 1;
        top: 50%;
        transform: translateY(-50%);
        transition: background .25s ease, color .25s ease, transform .25s ease;
        width: 44px;
        z-index: 3;
    }

    .rido-premium-products-section .owl-prev span,
    .rido-premium-products-section .owl-next span {
        display: block;
        line-height: 1;
        margin-top: -2px;
    }

    .rido-premium-products-section .owl-prev {
        left: 8px;
    }

    .rido-premium-products-section .owl-next {
        right: 8px;
    }

    .rido-premium-products-section .owl-prev:hover,
    .rido-premium-products-section .owl-next:hover {
        background: var(--theme-color1) !important;
        color: #fff !important;
    }

    .rido-premium-products-section .owl-dots {
        align-items: center;
        display: flex;
        gap: 12px;
        justify-content: center;
        padding-top: 26px;
    }

    .rido-premium-products-section .owl-dots .owl-dot,
    .rido-premium-products-section .owl-dots .owl-dot.active {
        align-items: center;
        background: transparent !important;
        border: 1px solid rgba(151, 23, 54, .35) !important;
        border-radius: 50%;
        display: inline-flex;
        height: 16px;
        justify-content: center;
        margin: 0 !important;
        position: relative;
        width: 16px;
    }

    .rido-premium-products-section .owl-dots .owl-dot::before,
    .rido-premium-products-section .owl-dots .owl-dot.active::before {
        display: none !important;
    }

    .rido-premium-products-section .owl-dots .owl-dot span {
        background: rgba(151, 23, 54, .45);
        border-radius: 50%;
        display: block;
        height: 8px;
        margin: 0;
        width: 8px;
    }

    .rido-premium-products-section .owl-dots .owl-dot.active {
        border-color: var(--theme-color1, #971736) !important;
    }

    .rido-premium-products-section .owl-dots .owl-dot.active span {
        background: var(--theme-color1, #971736);
    }

    @media (max-width: 1199px) {
        .rido-premium-products-section .project-thumb img {
            height: 250px;
        }
    }

    @media (max-width: 991px) {
        .rido-premium-products-section .row.carousel {
            padding: 0 48px;
        }

        .rido-premium-products-section .project-content {
            min-height: 270px;
        }
    }

    @media (max-width: 767px) {
        .rido-premium-products-section {
            padding-bottom: 62px !important;
        }

        .rido-premium-products-section .section-main-title {
            font-size: 30px;
            line-height: 1.2;
        }

        .rido-premium-products-section .rido-premium-heading-nowrap {
            white-space: normal;
        }

        .rido-premium-products-section .row.carousel {
            padding: 0 40px;
        }

        .rido-premium-products-section .project-thumb img {
            height: 230px;
        }

        .rido-premium-products-section .project-content {
            min-height: 255px;
        }

        .rido-premium-products-section h3.project-title a {
            font-size: 20px;
            min-height: auto;
        }

        .rido-premium-products-section h3.project-title {
            min-height: 72px;
            padding: 13px 20px;
        }

        .rido-premium-products-section p.project-text {
            font-size: 15px;
            line-height: 1.6;
            min-height: 0;
            padding: 13px 20px 22px;
        }

        .rido-premium-products-section .owl-prev,
        .rido-premium-products-section .owl-next {
            height: 38px;
            width: 38px;
        }
    }

    @media (max-width: 420px) {
        .rido-premium-products-section .row.carousel {
            padding: 0 34px;
        }

        .rido-premium-products-section .project-thumb {
            padding: 0;
        }

        .rido-premium-products-section .project-thumb img {
            height: 205px;
        }

        .rido-premium-products-section .project-content {
            min-height: 245px;
        }
    }
</style>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.jQuery || !jQuery.fn.owlCarousel) {
                return;
            }

            var $carousel = jQuery('.rido-premium-products-carousel');

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
                autoplayHoverPause: true,
                autoplayTimeout: 3000,
                dots: true,
                loop: true,
                margin: 30,
                nav: true,
                navText: ["<span>&lsaquo;</span>", "<span>&rsaquo;</span>"],
                smartSpeed: 900,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1100: {
                        items: 3
                    }
                }
            });
        });
    </script>
@endpush
