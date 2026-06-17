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
        background: url('images/bg/sky-bg.png') no-repeat center center;
        background-size: cover;
        background-color: whitesmoke;
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
        width: 350px;
        height: 500px;
        position: relative;
        transform-style: preserve-3d;
        perspective: 500px;
        border: none;
        transition: transform 0.5s;
        background-color: transparent;
        margin: 20px;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card .face {
        position: absolute;
        width: 100%;
        height: 100%;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
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
</style>

<div class="testimonial-area">
    <div class="container">
        <div class="section-title text-center">
            <h1 class="section-main-title"><span>TESTIMONIALS</span></h1>
        </div>
        <div class="row">
            <div class="testi_list owl-carousel">
                @foreach ($testimonials as $testimonial)
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
