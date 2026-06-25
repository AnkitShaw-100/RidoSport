<div id="all-blogs" class="blog-area style-grid rido-blog-section {{ !empty($isHomeBlogSection) ? 'rido-blog-section-home' : '' }}" style="
background: url('{{ asset('images/bg/about3-bg.png') }}') !important;
background-repeat: no-repeat;
background-position: center center;
background-size: cover;">
    @php
        $blogs = $blogs ?? collect();
    @endphp

    <div class="container rido-blog-container">
        <div class="row align-items-center rido-blog-heading">
            <div class="col-lg-6">
                <div class="section-title text-left">
                    <h1 class="section-main-title" style="text-transform: uppercase">Latest <span>Blog's</span></h1>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="project-right rido-blog-heading-actions">
                    <a class="rido-blog-top-button" href="{{ route('blog') }}#all-blogs">View All Posts</a>
                    <a class="rido-blog-top-button" href="{{ route('blog.add') }}">Add More Blog</a>
                </div>
            </div>
        </div>

        <div class="row rido-blog-grid">
            @forelse ($blogs as $blog)
                @php
                    $hasBanner = ! empty($blog->banner_public_id)
                        || (! empty($blog->banner_image_url) && ! str_contains($blog->banner_image_url, 'images/bg/blog-box.png'));
                @endphp
                <div class="col-lg-4 col-md-6">
                    <article class="rido-blog-card {{ $hasBanner ? '' : 'rido-blog-card-no-image' }}">
                        @if ($hasBanner)
                            <a href="{{ route('blog-details', $blog) }}" class="rido-blog-image">
                                <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}">
                            </a>
                        @endif
                        <div class="rido-blog-body">
                            <div class="rido-blog-meta">
                                <span><i class="far fa-user"></i> RidoSports</span>
                                <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3><a href="{{ route('blog-details', $blog) }}">{{ $blog->title }}</a></h3>
                            @php
                                $preview = preg_replace('/\s+/', ' ', trim(strip_tags($blog->safe_content)));
                                $previewLimit = $hasBanner ? 95 : 230;
                                $preview = strlen($preview) > $previewLimit ? substr($preview, 0, $previewLimit) . '...' : $preview;
                            @endphp
                            <p>{{ $preview }}</p>
                            <a class="rido-blog-readmore" href="{{ route('blog-details', $blog) }}">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="rido-blog-empty">
                        <h3>No blogs published yet.</h3>
                        <p>Please check back soon for RidoSports updates.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if (method_exists($blogs, 'hasPages') && $blogs->hasPages())
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-4">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .rido-blog-section {
        overflow: hidden;
        padding-bottom: 90px;
        padding-top: 90px;
    }

    .rido-blog-container {
        max-width: min(1170px, 75vw);
        width: min(1170px, 75vw);
    }

    .rido-blog-heading {
        margin-bottom: 28px;
    }

    .rido-blog-heading-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        justify-content: flex-end;
        margin-top: 0 !important;
        text-align: inherit;
    }

    .rido-blog-heading-actions::before {
        display: none !important;
    }

    .rido-blog-top-button {
        background: var(--theme-color1, #971736);
        border-radius: 999px;
        color: #fff;
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        line-height: 1;
        padding: 15px 24px;
        text-decoration: none;
        text-transform: uppercase;
    }

    .rido-blog-top-button:hover,
    .rido-blog-top-button:focus {
        background: var(--theme-color1, #971736);
        color: #fff;
        text-decoration: none;
    }

    .rido-blog-grid {
        row-gap: 30px;
    }

    .rido-blog-card {
        background: linear-gradient(180deg, #fff 0%, #fff 68%, #fbf7f8 100%);
        border: 1px solid rgba(151, 23, 54, .12);
        border-radius: 14px;
        box-shadow: 0 16px 36px rgba(5, 10, 30, .08);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
        position: relative;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .rido-blog-card::before {
        background: linear-gradient(90deg, var(--theme-color1, #971736), rgba(151, 23, 54, .08));
        content: "";
        height: 3px;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
        transition: opacity .25s ease;
        z-index: 2;
    }

    .rido-blog-card:hover {
        border-color: rgba(151, 23, 54, .34);
        box-shadow: 0 22px 46px rgba(5, 10, 30, .12);
        transform: translateY(-4px);
    }

    .rido-blog-card:hover::before {
        opacity: 1;
    }

    .rido-blog-image {
        background: #f4f4f4;
        display: block;
        height: 225px;
        overflow: hidden;
        position: relative;
    }

    .rido-blog-image::after {
        background: linear-gradient(180deg, rgba(5, 10, 30, 0) 44%, rgba(5, 10, 30, .34) 100%);
        bottom: 0;
        content: "";
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        z-index: 1;
    }

    .rido-blog-image img {
        display: block;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease;
        width: 100%;
    }

    .rido-blog-card:hover .rido-blog-image img {
        transform: scale(1.04);
    }

    .rido-blog-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 22px 22px 24px;
        position: relative;
    }

    .rido-blog-card-no-image .rido-blog-body {
        justify-content: center;
        min-height: 420px;
        padding-top: 30px;
    }

    .rido-blog-card-no-image .rido-blog-body p {
        -webkit-line-clamp: 8;
        min-height: auto;
    }

    .rido-blog-card-no-image .rido-blog-readmore {
        margin-top: 24px;
    }

    .rido-blog-meta {
        align-items: center;
        color: #6f7480;
        display: flex;
        flex-wrap: wrap;
        font-size: 11px;
        gap: 10px;
        letter-spacing: .02em;
        margin-bottom: 14px;
        text-transform: uppercase;
    }

    .rido-blog-meta span {
        align-items: center;
        display: inline-flex;
    }

    .rido-blog-meta i {
        color: var(--theme-color1, #971736);
        margin-right: 5px;
    }

    .rido-blog-body h3 {
        font-size: 21px;
        font-weight: 600;
        line-height: 1.3;
        margin: 0 0 14px;
    }

    .rido-blog-body h3 a {
        color: #050a1e;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        min-height: 54px;
        overflow: hidden;
        overflow-wrap: anywhere;
        text-decoration: none;
    }

    .rido-blog-body h3 a:hover {
        color: var(--theme-color1, #971736);
    }

    .rido-blog-body p {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        color: #626873;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 20px;
        min-height: 72px;
        overflow: hidden;
        overflow-wrap: anywhere;
    }

    .rido-blog-readmore {
        align-items: center;
        background: var(--theme-color1, #971736);
        border: 1px solid var(--theme-color1, #971736);
        border-radius: 8px;
        color: #fff;
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        gap: 8px;
        letter-spacing: .03em;
        margin-top: auto;
        padding: 11px 17px;
        text-decoration: none;
        text-transform: uppercase;
        width: fit-content;
    }

    .rido-blog-readmore:hover {
        background: #7f102b;
        border-color: #7f102b;
        color: #fff;
    }

    .rido-blog-empty {
        background: rgba(255, 255, 255, .82);
        border: 1px solid rgba(5, 10, 30, .08);
        border-radius: 8px;
        padding: 52px 20px;
        text-align: center;
    }

    .rido-blog-empty h3 {
        color: #050a1e;
        font-weight: 800;
    }

    @media (max-width: 1199px) {
        .rido-blog-container {
            max-width: 92%;
            width: 92%;
        }

        .rido-blog-image {
            height: 210px;
        }

        .rido-blog-body {
            padding: 20px;
        }
    }

    @media (max-width: 991px) {
        .rido-blog-heading {
            row-gap: 18px;
        }

        .rido-blog-heading .section-title {
            margin-bottom: 0 !important;
            text-align: center !important;
        }

        .rido-blog-heading .section-main-title {
            font-size: 34px;
            line-height: 1.18;
        }

        .rido-blog-heading-actions {
            justify-content: center;
        }

        .rido-blog-card-no-image .rido-blog-body {
            min-height: 340px;
        }
    }

    @media (max-width: 767px) {
        .rido-blog-container {
            max-width: calc(100% - 24px);
            width: calc(100% - 24px);
        }

        .rido-blog-section {
            padding-bottom: 62px;
            padding-top: 62px;
        }

        .rido-blog-heading {
            margin-bottom: 22px;
        }

        .rido-blog-heading .section-main-title {
            font-size: 29px;
        }

        .rido-blog-top-button {
            justify-content: center;
            padding: 13px 18px;
        }

        .rido-blog-image {
            height: 205px;
        }

        .rido-blog-body {
            padding: 19px;
        }

        .rido-blog-body h3 {
            font-size: 19px;
        }

        .rido-blog-body h3 a {
            min-height: auto;
        }

        .rido-blog-body p {
            min-height: auto;
        }

        .rido-blog-heading-actions {
            justify-content: center;
        }

        .rido-blog-section-home .rido-blog-grid {
            column-gap: 16px;
            display: flex;
            flex-wrap: nowrap;
            margin-left: 0;
            margin-right: 0;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 0 2px 18px;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }

        .rido-blog-section-home .rido-blog-grid > [class*="col-"] {
            flex: 0 0 calc(88% - 8px);
            max-width: calc(88% - 8px);
            padding-left: 0;
            padding-right: 0;
            scroll-snap-align: start;
        }

        .rido-blog-card-no-image .rido-blog-body {
            justify-content: flex-start;
            min-height: 320px;
        }

        .rido-blog-section-home .rido-blog-grid::-webkit-scrollbar {
            height: 4px;
        }

        .rido-blog-section-home .rido-blog-grid::-webkit-scrollbar-thumb {
            background: rgba(151, 23, 54, .35);
            border-radius: 999px;
        }
    }

    @media (max-width: 420px) {
        .rido-blog-container {
            max-width: calc(100% - 18px);
            width: calc(100% - 18px);
        }

        .rido-blog-heading-actions {
            align-items: center;
            flex-direction: row;
            gap: 10px;
            justify-content: center;
            width: 100%;
        }

        .rido-blog-top-button {
            flex: 1 1 0;
            font-size: 12px;
            max-width: 165px;
            padding-left: 12px;
            padding-right: 12px;
        }

        .rido-blog-section-home .rido-blog-grid > [class*="col-"] {
            flex-basis: 100%;
            max-width: 100%;
        }

        .rido-blog-image {
            height: 185px;
        }
    }

    @media (max-width: 360px) {
        .rido-blog-heading-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .rido-blog-top-button {
            max-width: none;
            width: 100%;
        }
    }
</style>
