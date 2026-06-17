<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Image') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            {{-- @method('PUT')  --}}
                            <!-- Caption Field -->
                            <div>
                                <x-input-label for="caption" :value="__('Caption')" />
                                <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full" :value="old('caption', $gallery->caption)"  autofocus autocomplete="caption" />
                                <x-input-error class="mt-2" :messages="$errors->get('caption')" />
                            </div>
                        
                            <!-- Current Image Display -->
                            <div class="mt-4">
                                <x-input-label for="current_image" :value="__('Current Image')" />
                                <img src="{{ url($gallery->image_path) }}" alt="Client Image" style="width:150px; height:auto;">
                            </div>
                        
                            <!-- Image Upload -->
                            <div class="mt-4">
                                <x-input-label for="image" :value="__('Change Image (Optional)')" />
                                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">PNG, WEBP up to 2MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                        
                            <!-- Form Actions -->
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('gallery.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
