<section class="banner-section">
    <div class="banner-slider">
        @if($banner)
            <div class="banner-slide">
                <!-- Dynamic video file -->
                <video autoplay loop muted style="width: 100vw; height: 100vh; object-fit: cover; position: absolute; top: 0; left: 0;">
                    <source src="{{ url( $banner->video_url) }}" type="video/mp4" />
                </video>

                <div class="outer-box">
                    <div class="auto-container">
                        <div class="content-box">
                            <!-- Dynamic tagline -->
                            <h1 data-animation-in="fadeInLeft" data-delay-in="0.2">
                                {{ $banner->tagline }}
                            </h1>
                            <div data-animation-in="fadeInUp" data-delay-in="0.3" class="text"></div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>No banner available.</p>
        @endif
    </div>
</section>

