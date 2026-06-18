<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>

    <div class="py-12 admin-blog-page">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="admin-blog-panel">
                @include('blog.partials.alerts')

                <div class="admin-blog-hero">
                    <div>
                        <p class="admin-blog-kicker">New Post</p>
                        <h3>Create Blog</h3>
                        <p>Add a banner, title, status, and long-form content for the public website.</p>
                    </div>
                    <a href="{{ route('blog-data.history') }}" class="admin-blog-button">Manage Blogs</a>
                </div>

                <form method="POST" action="{{ route('blog-data.store') }}" enctype="multipart/form-data" class="admin-blog-form">
                    @csrf

                    @include('blog.partials.form', ['blog' => null])

                    <div class="admin-blog-form-actions">
                        <button type="submit" class="admin-blog-submit">Save Blog</button>
                        <a href="{{ route('blog-data.history') }}" class="admin-blog-secondary">View Blog History</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('blog.partials.styles')
</x-app-layout>
