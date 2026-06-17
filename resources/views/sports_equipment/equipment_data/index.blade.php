<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EqupmentS Data') }}
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

                    <a href="{{ route('equipment-data.create') }}" class="btn btn-primary mb-4">Add New Equipment</a>

                    <table class="table-auto w-full border border-black">
                        <thead>
                            <tr class="border-b border-black">
                                <th class="p-2 border-r border-black">#</th>
                                <th class="p-2 border-r border-black">Sports Equipment Listing Name</th>
                                <th class="p-2 border-r border-black">Equipment Name</th>
                                <th class="p-2 border-r border-black">Equipment Image</th>
                                <th class="p-2 border-r border-black">Equipment Description</th>
                                <th class="p-2 border-r border-black">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipments as $index => $equipment)
                                <tr class="border-b border-black">
                                    <td class="p-2 border-r border-black">{{ $index + 1 }}</td>
                                    <td class="p-2 border-r border-black">{{ $equipment->sportsEquipment->name }}</td>
                                    <td class="p-2 border-r border-black">{{ $equipment->name }}</td>

                                    <td class="p-2 border-r border-black">
                                        <img src="{{ url('/' . $equipment->image) }}" alt="image" style="width:300px">
                                    </td>

                                    <td class="p-2 border-r border-black">
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            {{ $equipment->description }}
                                        </div>
                                    </td>

                                    <td class="p-2 border-r border-black">
                                        <a href="{{ route('equipment-data.edit', $equipment->id) }}" class="btn btn-warning">
                                            <i class="fas fa-pencil"></i></a>
                                        <form action="{{ route('equipment-data.destroy', $equipment->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $equipments->links() }}
                    </table>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{-- {{ $equipments->links() }}  <!-- Laravel's built-in pagination links --> --}}
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

                lightGallery(document.getElementById('carouselExample'), {
                    selector: '.carousel-item', // Use carousel items as the clickable elements
                    plugins: [lgThumbnail, lgZoom, lgFullscreen],
                    download: false,
                });

        });
    </script>
@endpush
