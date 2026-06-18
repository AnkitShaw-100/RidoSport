<div id="all-blogs" class="blog-area style-grid rido-blog-section" style="
background: url('{{ asset('images/bg/about3-bg.png') }}') !important;
background-repeat: no-repeat;
background-position: center center;
background-size: cover;">
    @php
        $blogs = $blogs ?? collect();
    @endphp

    <div class="container">
        <div class="row align-items-center rido-blog-heading">
            <div class="col-lg-6">
                <div class="section-title text-left">
                    <h1 class="section-main-title" style="text-transform: uppercase">Latest <span>Blog's</span></h1>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="project-right rido-blog-heading-actions">
                    <div class="rido-btn">
                        <a href="{{ route('blog') }}#all-blogs">View All Posts
                            <div class="rido-hover-btn hover-bx"></div>
                            <div class="rido-hover-btn hover-bx2"></div>
                            <div class="rido-hover-btn hover-bx3"></div>
                            <div class="rido-hover-btn hover-bx4"></div>
                        </a>
                    </div>
                    <div class="rido-btn">
                        <a href="{{ route('blog.add') }}">Add More Blog
                            <div class="rido-hover-btn hover-bx"></div>
                            <div class="rido-hover-btn hover-bx2"></div>
                            <div class="rido-hover-btn hover-bx3"></div>
                            <div class="rido-hover-btn hover-bx4"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row rido-blog-grid">
            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <article class="rido-blog-card">
                        <a href="{{ route('blog-details', $blog) }}" class="rido-blog-image">
                            <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}">
                        </a>
                        <div class="rido-blog-body">
                            <div class="rido-blog-meta">
                                <span><i class="far fa-user"></i> RidoSports</span>
                                <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3><a href="{{ route('blog-details', $blog) }}">{{ $blog->title }}</a></h3>
                            <p>{{ Str::limit(preg_replace('/\s+/', ' ', trim(strip_tags($blog->content))), 95, '...') }}</p>
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
        padding-bottom: 90px;
        padding-top: 90px;
    }

    .rido-blog-heading {
        margin-bottom: 28px;
    }

    .rido-blog-heading-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        justify-content: flex-end;
    }

    .rido-blog-grid {
        row-gap: 30px;
    }

    .rido-blog-card {
        background: #fff;
        border: 1px solid rgba(5, 10, 30, .08);
        border-radius: 8px;
        box-shadow: 0 12px 30px rgba(5, 10, 30, .07);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .rido-blog-card:hover {
        border-color: rgba(151, 23, 54, .42);
        box-shadow: 0 22px 44px rgba(5, 10, 30, .13);
        transform: translateY(-4px);
    }

    .rido-blog-image {
        background: #f4f4f4;
        display: block;
        height: 230px;
        overflow: hidden;
        position: relative;
    }

    .rido-blog-image::after {
        background: linear-gradient(180deg, rgba(5, 10, 30, 0) 45%, rgba(5, 10, 30, .28) 100%);
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
    }

    .rido-blog-meta {
        align-items: center;
        color: #7a7a7a;
        display: flex;
        flex-wrap: wrap;
        font-size: 12px;
        gap: 10px;
        margin-bottom: 11px;
        text-transform: uppercase;
    }

    .rido-blog-meta i {
        color: var(--theme-color1, #971736);
        margin-right: 5px;
    }

    .rido-blog-body h3 {
        font-size: 21px;
        font-weight: 500;
        line-height: 1.3;
        margin: 0 0 12px;
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
        color: #646464;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 20px;
        min-height: 76px;
        overflow: hidden;
        overflow-wrap: anywhere;
    }

    .rido-blog-readmore {
        align-items: center;
        background: #050a1e;
        border-radius: 6px;
        color: #fff;
        display: inline-flex;
        font-size: 13px;
        font-weight: 800;
        gap: 8px;
        letter-spacing: .03em;
        margin-top: auto;
        padding: 11px 15px;
        text-decoration: none;
        text-transform: uppercase;
        width: fit-content;
    }

    .rido-blog-readmore:hover {
        background: var(--theme-color1, #971736);
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

    @media (max-width: 767px) {
        .rido-blog-section {
            padding-bottom: 62px;
            padding-top: 62px;
        }

        .rido-blog-image {
            height: 210px;
        }

        .rido-blog-body {
            padding: 20px;
        }

        .rido-blog-heading-actions {
            justify-content: flex-start;
        }
    }
</style>
