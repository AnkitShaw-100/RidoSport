<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12 admin-blog-page">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="admin-blog-panel">
                @include('blog.partials.alerts')

                <div class="admin-blog-hero">
                    <div>
                        <p class="admin-blog-kicker">Blog History</p>
                        <h3>Manage Blogs</h3>
                        <p>Review posts, update content, and keep the website blog section fresh.</p>
                    </div>
                    <a href="{{ route('blog-data.create') }}" class="admin-blog-button">Create New Blog</a>
                </div>

                <div class="overflow-x-auto mt-6">
                    <table class="table-auto w-full admin-blog-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Banner</th>
                                <th>Content Preview</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <td class="admin-blog-title-cell">{{ $blog->title }}</td>
                                    <td>
                                        <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}" class="admin-blog-thumb">
                                    </td>
                                    <td class="admin-blog-preview-cell">
                                        {{ Str::limit(preg_replace('/\s+/', ' ', trim(strip_tags($blog->content))), 90, '...') }}
                                    </td>
                                    <td>{{ $blog->created_at?->format('d M Y') }}</td>
                                    <td>{{ $blog->updated_at?->format('d M Y') }}</td>
                                    <td>
                                        <span class="admin-blog-status admin-blog-status-{{ $blog->status ?? 'published' }}">
                                            {{ ucfirst($blog->status ?? 'published') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="admin-blog-actions">
                                            <a href="{{ route('blog-data.show', $blog->id) }}" class="admin-action-link admin-action-view">View</a>
                                            <a href="{{ route('blog-data.edit', $blog->id) }}" class="admin-action-link admin-action-edit">Edit</a>
                                            <form action="{{ route('blog-data.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this blog?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-action-link admin-action-delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-gray-500">
                                        No blogs have been created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('blog.partials.styles')
</x-app-layout>
