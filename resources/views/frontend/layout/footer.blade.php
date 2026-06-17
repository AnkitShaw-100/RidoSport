
<footer class="main-footer footer-style-one" style="background:url({{asset('images/bg/footer-bg.png')}}) no-repeat center center; background-size: cover; ">

    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">
                <!-- Contact Information Column -->
                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget contact-widget">
                        <div class="sec-title">
                            <span style="font-size:2.8rem; color: white; text-transform:uppercase">Ace your game with our Sports Portfolio</span>
                        </div>
                        <div class="widget-content">
                            <div class="content-box">
                                <div class="icon-box">
                                    <i class="flaticon-call"></i>
                                </div>
                                <span>Call Us</span>
                                <h6 class="title">
                                    <a href="tel:{{ get_mobile_number() }}" style="text-decoration: none; color: var(--theme-color4) !important;">(+91  {{ get_mobile_number() }})</a>
                                    <a href="tel: {{ get_mobile_number1() }}" style="text-decoration: none; color: var(--theme-color4) !important;">(+91  {{ get_mobile_number1() }})</a>
                                </h6>
                            </div>
                            
                            <div class="content-box">
                                <div class="icon-box">
                                    <i class="flaticon-envelope"></i>
                                </div>
                                <span>Mail us</span>
                                <h6 class="title">
                                    <a href="mailto:{{get_email_address()}}" style="text-decoration: none; color: var(--theme-color4) !important;">{{get_email_address()}}</a>
                                </h6>
                            </div>
                            <div class="content-box">
                                <div class="icon-box">
                                    <i class="flaticon-map"></i>
                                </div>
                                <span>Locate Us</span>
                                <h6 class="title">
                                    <a href="{{get_map_address()}}" style="text-decoration: none; color: var(--theme-color4) !important;">{{get_text_address()}}</a>
                                </h6>
                            </div>
                            <!-- <div class="content-box">
                                <div class="icon-box">
                                    <i class="flaticon-clock-3"></i>
                                </div>
                                <span>Open Time</span>
                                <h6 class="title" style="text-decoration: none; color: var(--theme-color4) !important;">09 AM - 06 PM, Sun - Thu</h6>
                            </div> -->
                            <ul class="social-icons">
                                <li><a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="#" aria-label="Behance"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Services Column -->
                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget links-widget pl-lg-30 pl-md--0">
                        <h4 class="widget-title">Products</h4>

                        <div class="widget-content">
                            <ul class="user-links style-two" style="padding-left: 0">
                                <ul class="user-links style-two" style="padding-left: 0">
                                    @foreach($products as $product)
                                        <li><a href="{{ $product->url }}">{{ $product->name }}</a></li>
                                    @endforeach
                                </ul>
                                
                                
                                <li><a href="#">Sports Equipments</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Useful Links Column -->
                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget links-widget two pl-lg-30 pl-md--0">
                        <h4 class="widget-title">Services</h4>
                        <div class="widget-content">
                            <ul class="user-links style-two" style="padding-left: 0">
                                @foreach($subservicesFooter as $subservice)
                                    <li><a href="{{$subservice->url}}">{{ $subservice->name }}</a></li>
                                @endforeach
                            </ul>
                            
                        </div>
                    </div>
                </div>

                <!-- Contact Form Column -->
                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h4 class="widget-title">Contact Us</h4>
                        <div class="form-column" style="padding-left: 0px">
                            <form method="POST" action="{{ route('contact-store') }}" id="">
                                @csrf <!-- This is required for form security in Laravel -->
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <div class="input-outer">
                                            <input type="text" name="name" placeholder="Your Name" required>
                                            <span class="icon fa fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="input-outer">
                                            <input type="email" name="email" placeholder="Email Id" required>
                                            <span class="icon fa fa-envelope"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="input-outer">
                                            <input type="text" name="phone" placeholder="Phone Number" required>
                                            <span class="icon fa fa-phone"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="input-outer">
                                            <textarea name="message" placeholder="Message" required></textarea>
                                            <span class="icon fa fa-paper-plane"></span>
                                        </div>
                                    </div>
									<!--<div class="g-recaptcha" data-sitekey="6LcUIW8qAAAAAH8nhtqxLXsj93tqWko7ccrD0zCX"></div>-->
									<input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">
                                    <div class="form-group col-lg-12">
                                        <button class="theme-btn" type="submit" name="submit-form">
                                            <span class="btn-title">Send Your Message</span>
                                            <i class="flaticon-arrow-pointing-to-right btn-icon ml-10"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container">
                <div class="copyright-text">© Copyright 2024 Designed by <a href="https://webiantdigitalindia.com/" target="_blank" rel="noopener noreferrer">WebiantDigitalIndia</a></div>
            </div>
        </div>
    </div>

    <div class="scroll-to-top scroll-to-target arrow-btn" data-target="html">
        <i class="fa-sharp fa-solid fa-arrow-up"></i>
    </div>
</footer>

  <a href="https://wa.me/+91{{ get_mobile_number1() }}" class="whatsapp">
      <img src="{{url('images/icons/whatsapp.gif')}}" alt="WhatsApp" >
  </a>
  <a href="tel:{{ get_mobile_number() }}" class="phones">
      <img src="{{url('images/icons/call.gif')}}" alt="Call" >
  </a>  
</div>






<!-- jQuery Library (necessary for many other plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (necessary for Bootstrap tooltips and popovers) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS (Ensure only one version of Bootstrap is included) -->
<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel JS (depends on jQuery) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{url('js/owl.carousel.min.js')}}"></script> <!-- Custom Owl Carousel JS -->

<!-- Swiper JS (carousel functionality) -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- LightGallery JS and Plugins -->
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/video/lg-video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/fullscreen/lg-fullscreen.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/zoom/lg-zoom.min.js"></script>

<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/4.0.30/fancybox.umd.js"></script>

<!-- Magnific Popup JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- Project-Specific and Additional Plugins -->
<script src="{{url('js/popper.min.js')}}"></script> <!-- If this is a custom script, keep it -->
<script src="{{url('js/bootstrap.min.js')}}"></script> <!-- Only keep this if it's part of your project structure -->
<script src="{{url('js/slick.min.js')}}"></script>
<script src="{{url('js/slick-animation.min.js')}}"></script>
<script src="{{url('js/jquery.fancybox.js')}}"></script>
<script src="{{url('js/progress-bar.js')}}"></script>
<script src="{{url('js/wow.js')}}"></script>
<script src="{{url('js/appear.js')}}"></script>
<script src="{{url('js/mixitup.js')}}"></script>
<script src="{{url('js/script.js')}}"></script>

<!-- AOS library for animations -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<!-- Project's Theme and Custom Scripts -->
<script src="{{url('js/theme.js')}}"></script>

<script src="https://www.google.com/recaptcha/api.js?render=6LcVZdIqAAAAAF3KBkE1T-i1lDm95dxmpQQDH6r5"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config("services.recaptcha.site_key") }}', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaResponse').value = token;
        });
    });
</script>


<!-- Initialization Scripts -->
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,         // Enable infinite looping
            margin: 10,         // Space between items
            nav: true,          // Enable next/prev buttons
            dots: true,         // Show dots
            autoplay: true,     // Enable autoplay
            autoplayTimeout: 5000, // Time between slides
            responsive: {
                0: {
                    items: 1        // Show 1 item on small screens
                },
                600: {
                    items: 1        // Show 1 item on medium screens
                },
                1000: {
                    items: 1        // Show 1 item on large screens
                }
            }
        });

        // Initialize Swiper
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3, // Adjust the number of slides per view
            spaceBetween: 30,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
        });

        // Initialize LightGallery
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.gallery-item', // Select elements with the 'gallery-item' class
            plugins: [lgThumbnail, lgFullscreen], // Include additional plugins if needed
            speed: 500,
        });

        // Initialize Magnific Popup for YouTube videos
        $('.popup-youtube').magnificPopup({
            type: 'iframe'
        });
    });
</script>

@stack('script')
</body>
</html>
