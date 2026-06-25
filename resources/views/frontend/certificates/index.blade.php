<section class="award-section rido-accreditation-section">
    <div class="award-container rido-accreditation-container">
        <div class="sec-title text-center">
            <h2>Accreditation</h2>
        </div>

        <div class="rido-accreditation-shell">
            <button class="rido-accreditation-nav rido-accreditation-prev" type="button" aria-label="Previous accreditation">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="rido-accreditation-carousel" aria-label="Accreditation carousel">
                @foreach($certificates as $certificate)
                    <div class="award-card rido-accreditation-card">
                        <img src="{{ url($certificate->certified_by_logo) }}" alt="{{ $certificate->certified_by_company_name }}" class="company-logo">
                        <div class="award-info">
                            <h3>{{ $certificate->certified_by_company_name }}</h3>
                            <p>
                                <span class="span-1">Awarded For</span><br>
                                <span>{{ $certificate->certified_for }}</span><br>
                                <b>({{ $certificate->product_name }})</b>
                            </p>
                            <a href="{{ route('certificate.download', $certificate) }}" class="rido-certificate-download">
                                <i class="fa-solid fa-file-arrow-down"></i>
                                Download PDF
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="rido-accreditation-nav rido-accreditation-next" type="button" aria-label="Next accreditation">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
        .rido-accreditation-section {
            overflow: hidden;
        }

        .rido-accreditation-container {
            margin: 0 auto;
            max-width: 1360px;
            padding: 68px 15px !important;
            text-align: center;
        }

        .rido-accreditation-shell {
            padding: 0 54px;
            position: relative;
        }

        .rido-accreditation-carousel {
            display: grid;
            gap: 30px;
            grid-auto-columns: calc((100% - 60px) / 3);
            grid-auto-flow: column;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 10px 0 28px;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
        }

        .rido-accreditation-carousel::-webkit-scrollbar {
            display: none;
        }

        .rido-accreditation-card {
            align-items: center;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 575px;
            opacity: 1;
            padding: 24px 24px 28px;
            scroll-snap-align: start;
            text-align: center;
            transform: none;
            transition: transform 0.3s ease, opacity 0.3s ease, box-shadow 0.3s ease;
        }

        .rido-accreditation-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px);
        }

        .rido-accreditation-card .company-logo {
            background: #f8f9fc;
            border: 1px solid rgba(151, 23, 54, .12);
            border-radius: 8px;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .8);
            height: 265px;
            margin-bottom: 22px;
            max-width: 100%;
            object-fit: contain;
            padding: 10px;
            width: 100%;
        }

        .rido-accreditation-card .award-info {
            display: flex;
            flex: 1;
            flex-direction: column;
            justify-content: flex-start;
            width: 100%;
        }

        .rido-accreditation-card .award-info h3 {
            color: var(--theme-color1);
            font-size: 2rem;
            line-height: 1.25;
            margin-bottom: 20px;
            overflow-wrap: anywhere;
        }

        .rido-accreditation-card .award-info p {
            font-size: 1.62rem;
            line-height: 1.45;
            margin-bottom: 18px;
            overflow-wrap: anywhere;
        }

        .rido-certificate-download {
            align-items: center;
            align-self: center;
            background: var(--theme-color1, #971736);
            border: 1px solid var(--theme-color1, #971736);
            border-radius: 999px;
            color: #fff;
            display: inline-flex;
            font-size: 13px;
            font-weight: 800;
            gap: 8px;
            justify-content: center;
            line-height: 1;
            margin-top: auto;
            padding: 12px 18px;
            text-decoration: none;
            text-transform: uppercase;
            width: fit-content;
        }

        .rido-certificate-download:hover,
        .rido-certificate-download:focus {
            background: #7f102b;
            border-color: #7f102b;
            color: #fff;
            text-decoration: none;
        }

        .rido-accreditation-card .award-info .span-1 {
            background-color: rgba(151, 23, 55, 0.381);
            border: 1px solid var(--theme-color1);
            border-radius: 20px;
            color: var(--theme-color2);
            display: inline-block;
            font-weight: bold;
            margin-bottom: 16px;
            padding: 7px 10px;
        }

        .rido-accreditation-card .award-info span {
            color: #000;
            font-weight: bold;
        }

        .rido-accreditation-nav {
            align-items: center;
            background: #fff;
            border: 1px solid rgba(151, 23, 54, .32);
            border-radius: 50%;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
            color: var(--theme-color1);
            cursor: pointer;
            display: flex;
            height: 42px;
            justify-content: center;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            transition: background .2s ease, color .2s ease, opacity .2s ease;
            width: 42px;
            z-index: 3;
        }

        .rido-accreditation-nav:hover {
            background: var(--theme-color1);
            color: #fff;
        }

        .rido-accreditation-nav:disabled {
            cursor: not-allowed;
            opacity: .35;
        }

        .rido-accreditation-nav:disabled:hover {
            background: #fff;
            color: var(--theme-color1);
        }

        .rido-accreditation-shell.is-static .rido-accreditation-nav {
            display: none;
        }

        .rido-accreditation-prev {
            left: 0;
        }

        .rido-accreditation-next {
            right: 0;
        }

        @media (max-width: 991px) {
            .rido-accreditation-carousel {
                grid-auto-columns: calc((100% - 30px) / 2);
            }

            .rido-accreditation-shell {
                padding: 0 48px;
            }

            .rido-accreditation-card {
                min-height: 545px;
                padding: 24px;
            }

            .rido-accreditation-card .company-logo {
                height: 245px;
            }

            .rido-accreditation-card .award-info h3 {
                margin-bottom: 18px;
            }
        }

        @media (max-width: 575px) {
            .rido-accreditation-container {
                padding: 48px 14px !important;
            }

            .rido-accreditation-shell {
                padding: 0 42px;
            }

            .rido-accreditation-carousel {
                gap: 18px;
                grid-auto-columns: 100%;
                padding-bottom: 20px;
            }

            .rido-accreditation-card {
                min-height: 510px;
                padding: 22px 18px 24px;
            }

            .rido-accreditation-card .company-logo {
                height: 230px;
                margin-bottom: 20px;
            }

            .rido-accreditation-card .award-info h3 {
                font-size: 1.55rem;
                margin-bottom: 16px;
            }

            .rido-accreditation-card .award-info p {
                font-size: 1.28rem;
            }

            .rido-accreditation-nav {
                height: 36px;
                width: 36px;
            }
        }
</style>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.rido-accreditation-shell').forEach(function (shell) {
                var carousel = shell.querySelector('.rido-accreditation-carousel');
                var prev = shell.querySelector('.rido-accreditation-prev');
                var next = shell.querySelector('.rido-accreditation-next');

                if (!carousel || !prev || !next) {
                    return;
                }

                function getScrollStep() {
                    var card = carousel.querySelector('.rido-accreditation-card');
                    var styles = window.getComputedStyle(carousel);
                    var gap = parseFloat(styles.columnGap || styles.gap || 0) || 0;

                    if (!card) {
                        return carousel.clientWidth;
                    }

                    return card.getBoundingClientRect().width + gap;
                }

                function updateButtons() {
                    var maxScroll = carousel.scrollWidth - carousel.clientWidth;

                    prev.disabled = carousel.scrollLeft <= 2;
                    next.disabled = carousel.scrollLeft >= maxScroll - 2;
                    shell.classList.toggle('is-static', maxScroll <= 2);
                }

                prev.addEventListener('click', function () {
                    carousel.scrollBy({
                        left: -getScrollStep(),
                        behavior: 'smooth'
                    });
                });

                next.addEventListener('click', function () {
                    carousel.scrollBy({
                        left: getScrollStep(),
                        behavior: 'smooth'
                    });
                });

                carousel.addEventListener('scroll', function () {
                    window.requestAnimationFrame(updateButtons);
                });

                window.addEventListener('resize', updateButtons);
                updateButtons();
            });
        });
    </script>
@endpush
