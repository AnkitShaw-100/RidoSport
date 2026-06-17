<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Display Success and Failure Messages --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('failure'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('failure') }}</span>
                        </div>
                    @endif

                    <a href="{{ route('project-data.create') }}" class="btn btn-primary mb-4">Add New Project</a>

                    <table class="table-auto w-full border border-black">
                        <thead>
                            <tr class="border-b border-black">
                                <th class="p-2 border-r border-black">#</th>
                                <th class="p-2 border-r border-black">SubService Name</th>
                                <th class="p-2 border-r border-black">Project Title</th>
                                <th class="p-2 border-r border-black">Project Images</th>
                                <th class="p-2 border-r border-black">Project Description</th>
                                <th class="p-2 border-r border-black">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $index => $project)
                                <tr class="border-b border-black">
                                    <td class="p-2 border-r border-black">{{ $index + 1 }}</td>
                                    <td class="p-2 border-r border-black">{{ $project->subservice->name }}</td>
                                    <td class="p-2 border-r border-black">{{ $project->title }}</td>

                                    <td class="p-2 border-r border-black">
                                        {{-- Carousel + LightGallery --}}
                                        <div id="carouselExample{{ $index }}" class="carousel slide" data-bs-ride="carousel" style="max-width: 300px; height: 200px;">
                                            <div class="carousel-inner" style="height: 200px;">
                                                @foreach(json_decode($project->images, true) as $imgIndex => $image)
                                                    <div class="carousel-item {{ $imgIndex === 0 ? 'active' : '' }}" style="height: 200px;">
                                                        <a href="{{ url($image) }}">
                                                            <img src="{{ url($image) }}" alt="{{ $project->title }}" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $index }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $index }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>

                                    <td class="p-2 border-r border-black">
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            {{ $project->description }}
                                        </div>
                                    </td>

                                    <td class="p-2 border-r border-black">
                                        <a href="{{ route('project-data.edit', $project->id) }}" class="btn btn-warning">
                                            <i class="fas fa-pencil"></i></a>
                                        <form action="{{ route('project-data.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $projects->links() }}
                    </table>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{-- {{ $projects->links() }}  <!-- Laravel's built-in pagination links --> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- Include LightGallery Scripts --}}
@push('script')
    <!-- LightGallery JS and Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/fullscreen/lg-fullscreen.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/zoom/lg-zoom.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize LightGallery for the carousel images
            @foreach($projects as $index => $project)
                lightGallery(document.getElementById('carouselExample{{ $index }}'), {
                    selector: '.carousel-item', // Use carousel items as the clickable elements
                    plugins: [lgThumbnail, lgZoom, lgFullscreen],
                    download: false,
                });
            @endforeach
        });
    </script>
@endpush
