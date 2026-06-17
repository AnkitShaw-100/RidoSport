<section class="award-section">
    <div class="award-container" style="padding: 60px">
        <div class="sec-title text-center">
            <h2>Accreditation</h2>
        </div>
        <div class="awards-grid">
            <!-- Loop through the certificates -->
            @foreach($certificates as $certificate)
                <div class="award-card">
                    <!-- Display the certificate logo -->
                    <img src="{{ url($certificate->certified_by_logo) }}" alt="{{$certificate->certified_by_company_name}}" class="company-logo ">
                    <div class="award-info">
                        <!-- Display the company name -->
                        <h3>{{ $certificate->certified_by_company_name }}</h3>
                        <p>
                            <span class="span-1">Awarded For <br></span>
                            <!-- Display the certified_for and product_name fields -->
                            <span>{{ $certificate->certified_for }} <br>
                            <b>({{ $certificate->product_name }})</b></span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@push('style')
    <style>
        <style>
        /* Container */
        .container {
            margin: auto;
            text-align: center;
        }
        /* Awards Grid */
        .awards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 30px;
        }

        /* Award Cards */
        .award-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            opacity: 0;
            transform: translateY(50px);
            transition: transform 0.3s ease, opacity 0.3s ease;
            text-align: center;
        }

        .award-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        
        }

        /* Company Logo */
        .company-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }


        /* Award Info */
        .award-info h3 {
            font-size: 1.8rem;
            color: var(--theme-color1);
            margin-bottom: 10px;
        }

        .award-info p {
        font-size: 1.5rem;
        
        }
        .award-info .span-1 {
            color: var(--theme-color2);
            background-color: rgba(151, 23, 55, 0.381);
            border:1px solid var(--theme-color1);
            font-weight: bold;
            border-radius: 20px;
            padding: 5px;
        }
        .award-info span {
            color:#000;
            font-weight: bold;
        }

    /* Responsive Adjustments */
    @media (max-width: 768px) {

        .awards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        .award-info h3 {
            font-size: 1.6rem; /* Adjust font size for smaller screens */
        }

        .award-info p {
            font-size: 1.3rem; /* Adjust font size for smaller screens */
        }
    }

    @media (max-width: 576px) {

        .awards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .award-info h3 {
            font-size: 1.4rem; /* Further adjust font size for very small screens */
        }

        .award-info p {
            font-size: 1.2rem; /* Further adjust font size for very small screens */
        }
    }
    </style>
@endpush
@push('script')
<script>
    window.addEventListener('load', () => {
        const awardCards = document.querySelectorAll('.award-card');
        awardCards.forEach((card, index) => {
            setTimeout(() => {
            card.style.opacity = 1;
            card.style.transform = 'translateY(0)';
            }, index * 200); 
        });
    });
</script>
@endpush

