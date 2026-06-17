@extends('frontend.layout.main1')
@push('title')
<title>Desan International | Contact Us</title>
@endpush
@section('main-section1')
<section class="page-title" style="background-image: url('{{ asset('images/bg/3.png') }}');">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{$pageTitle}}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{$pageRoute}}">{{$pageTitle}}</a></li>
            </ul>
        </div>
    </div>
</section>
    <div class="contact-area" style="background: url('{{ url('images/bg/contact-bg2.png') }}');  background-size: cover;  
    background-position: center;
    ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="section-title text-left">
                        <h5 class="section-sub-title">CONTACT US</h5>
                        <h1 class="section-main-title">Make an Online Appoinemnt</h1>
                        <h1 class="section-main-title">For RidoSports Services.</h1>
                    </div>
                    <div class="contact_from_box">
                        @if(session('status'))
                            <div id="success-alert" class="alert alert-success" style="font-size: 1.5rem">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('contact-store')}}" method="POST" id="">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form_box">
                                        <input type="text" name="name" placeholder="Your Name *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form_box">
                                        <input type="email" name="email" placeholder="Your E-Mail *">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form_box">
                                        <input type="text" name="phone" placeholder="Phone *" maxlength="10" minlength="10">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form_box">
                                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>
									<!--<div class="g-recaptcha" data-sitekey="6LcUIW8qAAAAAH8nhtqxLXsj93tqWko7ccrD0zCX"></div>-->
									<input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">
                                    <div class="quote_button">
                                        <button class="btn" type="submit">SEND NOW <i class="bi bi-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="google-map">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3500.8389171898098!2d77.34749567550196!3d28.66454147564733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDM5JzUyLjQiTiA3N8KwMjEnMDAuMyJF!5e0!3m2!1sen!2sin!4v1720612576830!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        #success-alert {
            position: fixed; /* Use fixed positioning */
            top: 60%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Shift back by half its width and height */
            z-index: 1000;
            display: none; /* Initially hidden */
            padding: 20px; /* Add some padding */
            background-color: #28a745; /* Bootstrap success color */
            color: white; /* Text color */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Optional shadow */
        }
        
        .page-wrapper{
            z-index:0;
        }
    </style>
@endpush
@push('script')

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config("services.recaptcha.site_key") }}', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaResponse').value = token;
        });
    });
</script>
    
<script>
    $(document).ready(function() {
        // Check if the success alert exists
        if ($('#success-alert').length) {
            // Show the alert
            $('#success-alert').fadeIn();

            // Hide the alert after 5 seconds
            setTimeout(function() {
                $('#success-alert').fadeOut();
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    });
</script>
@endpush