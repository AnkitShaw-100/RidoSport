<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Image') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Provide the necessary details for the new image.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="caption" :value="__('Image Caption')" />
                                <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full" :value="old('caption')"  autofocus autocomplete="caption" />
                                <x-input-error class="mt-2" :messages="$errors->get('caption')" />
                            </div>
                            <!-- Image Upload -->
                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Size up to 10MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('gallery.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
