<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Blog') }}
        </h2>
    </x-slot>

    <div class="py-12 admin-blog-page">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="admin-blog-panel">
                <div class="admin-blog-hero">
                    <div>
                        <p class="admin-blog-kicker">Preview</p>
                        <h3>{{ $blog->title }}</h3>
                        <p>{{ $blog->created_at?->format('d M Y h:i A') }} · {{ ucfirst($blog->status ?? 'published') }}</p>
                    </div>
                    <a href="{{ route('blog-data.history') }}" class="admin-blog-button">Manage Blogs</a>
                </div>

                <div class="admin-blog-preview mt-6">
                    <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}">
                    <div class="admin-blog-preview-body">
                        <h1>{{ $blog->title }}</h1>
                        @foreach (preg_split("/\r\n|\n|\r/", $blog->content) as $paragraph)
                            @if (trim($paragraph) !== '')
                                <p>{{ $paragraph }}</p>
                            @endif
                        @endforeach
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
