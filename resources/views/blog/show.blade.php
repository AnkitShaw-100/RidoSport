<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Blog') }}
        </h2>
    </x-slot>

    <div class="py-12 admin-blog-page">
        <div class="admin-blog-view-wrap mx-auto sm:px-6 lg:px-8">
            <div class="admin-blog-panel">
                <div class="admin-blog-hero">
                    <div>
                        <p class="admin-blog-kicker">Preview</p>
                        <h3>{{ $blog->title }}</h3>
                        <p>{{ $blog->created_at?->format('d M Y h:i A') }} - {{ ucfirst($blog->status ?? 'published') }}</p>
                    </div>
                    <a href="{{ route('blog-data.history') }}" class="admin-blog-button">Manage Blogs</a>
                </div>

                @php
                    $hasBanner = ! empty($blog->banner_public_id)
                        || (! empty($blog->banner_image_url) && ! str_contains($blog->banner_image_url, 'images/bg/blog-box.png'));
                @endphp

                <div class="admin-blog-view-shell mt-6">
                    @if ($hasBanner)
                        <div class="admin-blog-view-banner">
                            <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}">
                        </div>
                    @endif

                    <div class="admin-blog-view-grid">
                        <article class="admin-blog-preview">
                            <div class="admin-blog-preview-body">
                                <div class="admin-blog-view-meta">
                                    <span>{{ $blog->created_at?->format('d M Y') }}</span>
                                    <span>{{ $blog->created_at?->format('h:i A') }}</span>
                                    <span>{{ ucfirst($blog->status ?? 'published') }}</span>
                                </div>

                                <h1>{{ $blog->title }}</h1>

                                <div class="admin-blog-preview-copy">
                                    @if ($blog->safe_content !== strip_tags($blog->safe_content))
                                        {!! $blog->safe_content !!}
                                    @else
                                        @foreach (preg_split("/\r\n|\n|\r/", $blog->safe_content) as $paragraph)
                                            @if (trim($paragraph) !== '')
                                                <p>{{ $paragraph }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </article>

                        <aside class="admin-blog-view-summary">
                            <p class="admin-blog-kicker">Post Details</p>
                            <dl>
                                <div>
                                    <dt>Status</dt>
                                    <dd>{{ ucfirst($blog->status ?? 'published') }}</dd>
                                </div>
                                <div>
                                    <dt>Created</dt>
                                    <dd>{{ $blog->created_at?->format('d M Y h:i A') }}</dd>
                                </div>
                                <div>
                                    <dt>Updated</dt>
                                    <dd>{{ $blog->updated_at?->format('d M Y h:i A') }}</dd>
                                </div>
                                <div>
                                    <dt>Banner</dt>
                                    <dd>{{ $hasBanner ? 'Uploaded' : 'Not added' }}</dd>
                                </div>
                            </dl>
                        </aside>
                    </div>
                </div>

                <div class="admin-blog-form-actions mt-6">
                    <a href="{{ route('blog-data.edit', $blog->id) }}" class="admin-blog-submit">Edit Blog</a>
                    <a href="{{ route('blog-data.history') }}" class="admin-blog-secondary">Back to History</a>
                </div>
            </div>
        </div>
    </div>

    @include('blog.partials.styles')
</x-app-layout>
