<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Testimonial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Testimonial') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Provide the necessary details for the new testimonial.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('testimonial.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            <!-- Author Name -->
                            <div>
                                <x-input-label for="author_name" :value="__('Author Name')" />
                                <x-text-input id="author_name" name="author_name" type="text" class="mt-1 block w-full" :value="old('author_name')" required autofocus autocomplete="author_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('author_name')" />
                            </div>

                            <div>
                                <x-input-label for="author_image" :value="__('Certified By Logo')" />
                                <input type="file" name="author_image" id="author_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">File Size up to 10MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('author_image')" />
                            </div>
                            <!-- Author Designation -->
                            <div>
                                <x-input-label for="author_designation" :value="__('Author Designation')" />
                                <x-text-input id="author_designation" name="author_designation" type="text" class="mt-1 block w-full" :value="old('author_designation')" required autofocus autocomplete="author_designation" />
                                <x-input-error class="mt-2" :messages="$errors->get('author_designation')" />
                            </div>

                            <!-- Message -->
                            <div>
                                <x-input-label for="message" :value="__('Message')" />
                                <x-text-input id="message" name="message" type="text" class="mt-1 block w-full" :value="old('message')" required autofocus autocomplete="message" />
                                <x-input-error class="mt-2" :messages="$errors->get('message')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('testimonial.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
