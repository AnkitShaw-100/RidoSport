<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Project') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update the necessary details for the project.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('project-data.update', $project->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <!-- SubService Selection -->
                            <div>
                                <x-input-label for="subservice_id" :value="__('SubService')" />
                                <select name="subservice_id" id="subservice_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                                    <option value="">Select SubService</option>
                                    @foreach ($subservices as $subservice)
                                        <option value="{{ $subservice->id }}" {{ old('subservice_id', $project->subservice_id) == $subservice->id ? 'selected' : '' }}>{{ $subservice->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('subservice_id')" />
                            </div>

                            <!-- Project Title -->
                            <div>
                                <x-input-label for="title" :value="__('Project Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $project->title)" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Project Description -->
                            <div>
                                <x-input-label for="description" :value="__('Project Description')" />
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required autocomplete="description" cols="30" rows="5">{{ old('description', $project->description) }}</textarea>
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Length up to 350 characters</p>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Current Project Images -->
                            {{-- <div class="mt-4">
                                <x-input-label for="current-images" :value="__('Current Project Images')" />

                                <div class="d-flex flex-wrap gap-2"> <!-- Flex container for inline display -->
                                    @foreach(json_decode($project->images, true) as $imgIndex => $image)
                                        <div>
                                            <a href="{{ url($image) }}" target="_blank">
                                                <img src="{{ url($image) }}" alt="{{ $project->title }}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">These are the current project images.</p>
                            </div>


                            <!-- Upload New Project Images -->
                            <div>
                                <x-input-label for="images" :value="__('Upload New Project Images (optional)')" />
                                <input type="file" name="images[]" id="images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" multiple />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">You can upload multiple new images. Leave blank if you do not wish to change the current images.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('images')" />
                            </div> --}}

                            <!-- Current Project Images -->
                            <div class="mt-4">
                                <x-input-label for="current-images" :value="__('Current Project Images')" />

                                <div class="d-flex flex-wrap gap-2"> <!-- Flex container for inline display -->
                                    @foreach(json_decode($project->images, true) as $imgIndex => $image)
                                        <div class="position-relative">
                                            <a href="{{ url($image) }}" target="_blank">
                                                <img src="{{ url($image) }}" alt="{{ $project->title }}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                            </a>
                                            <!-- Add checkbox for image deletion -->
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="delete_images[]" value="{{ $image }}">
                                                    {{ __('Delete') }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Select images to delete.</p>
                            </div>

                            <!-- Upload New Project Images -->
                            <div>
                                <x-input-label for="images" :value="__('Upload New Project Images (optional)')" />
                                <input type="file" name="images[]" id="images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" multiple />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">You can upload multiple new images. Leave blank if you do not wish to change the current images.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('images')" />
                            </div>


                            <!-- Form Actions -->
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('project-data.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
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
