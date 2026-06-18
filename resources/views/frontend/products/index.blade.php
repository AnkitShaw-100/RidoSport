<!-- resources/views/products/index.blade.php -->
<div class="project-area style-two" style="background: url('images/bg/pproject.png') !important; background-repeat: no-repeat; background-position: center center; background-size: cover;">
    <div class="container-fluid">
        <div class="row project align-items-center">
            <div class="col-lg-6">
                <div class="section-title text-left">
                    <h1 class="section-main-title" style="text-transform: uppercase">Enhance your game with our <span>Premium Products</span></h1>
                </div>
            </div>
        </div>
        <div class="row carousel">
            <div class="project_list owl-carousel">
                @foreach($product_cards as $productCard)
                    <div class="col-lg-12 col-md-12">
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
