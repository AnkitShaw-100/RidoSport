<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Display Success Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Display Failure/Error Message --}}
                    @if (session('failure'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('failure') }}</span>
                        </div>
                    @endif

                    <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-4">Add New Image</a>

                    {{-- Gallery Images in Card Layout --}}
                    <div id="lightgallery" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                        @foreach ($gallery as $image)
                            <div class="bg-white border rounded-lg shadow-sm p-4">
                                {{-- Image thumbnail --}}
                                <a href="{{ url($image->image_path) }}" data-lg-size="1600-1067" class="gallery-item">
                                    {{-- <img src="{{ url($image->image_path) }}" alt="Gallery Image" class="rounded w-full h-48 object-contain"> --}}
                                    {{-- <img src="{{ url($image->image_path) }}" alt="Gallery Image" class="rounded w-full h-48 object-cover"> --}}
                                    <img src="{{ url($image->image_path) }}" alt="Gallery Image" class="rounded w-full h-64 object-cover">

                                </a>

                                {{-- Image Caption --}}
                                <div class="mt-2 text-center text-gray-700">
                                    {{ $image->caption }} <!-- Display the caption here -->
                                </div>

                                {{-- Buttons for Edit and Delete --}}
                                <div class="mt-4 text-center d-flex align-content-center justify-content-center">
                                    
                                    <a href="{{ route('gallery.edit', $image->id) }}" class="btn btn-primary font-bold py-2 px-4 rounded-full">
                                                <i class="fas fa-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('gallery.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Include LightGallery CDN scripts --}}
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lightGallery(document.getElementById('lightgallery'), {
                selector: '.gallery-item'
            });
        });
    </script>
@endpush
