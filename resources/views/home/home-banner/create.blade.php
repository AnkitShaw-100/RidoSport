<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Banner Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Banner Video') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Provide the necessary details for the new banner.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('home-banner.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <!-- Tagline Field -->
                            <div>
                                <x-input-label for="tagline" :value="__('Tagline')" />
                                <x-text-input id="tagline" name="tagline" type="text" class="mt-1 block w-full" :value="old('tagline')"  autofocus autocomplete="tagline" />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Tagline should be upto 50 Characters</p>
                                <x-input-error class="mt-2" :messages="$errors->get('tagline')" />
                            </div>

                            <!-- Video Upload -->
                            <div>
                                <x-input-label for="video_url" :value="__('Video')" />
                                <input type="file" name="video_url" id="video_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Video size up to 50MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('video_url')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('home-banner.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
