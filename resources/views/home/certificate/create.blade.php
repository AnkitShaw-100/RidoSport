<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Certificate Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Certificate Data') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Provide the necessary details for the new certificate.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('certificate.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <!-- Certified By Logo (Image Upload) -->
                            <div>
                                <x-input-label for="certified_by_logo" :value="__('Certified By Logo')" />
                                <input type="file" name="certified_by_logo" id="certified_by_logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">PNG, WEBP up to 2MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('certified_by_logo')" />
                            </div>

                            <!-- Certified By Company Name -->
                            <div>
                                <x-input-label for="certified_by_company_name" :value="__('Certified By Company Name')" />
                                <x-text-input id="certified_by_company_name" name="certified_by_company_name" type="text" class="mt-1 block w-full" :value="old('certified_by_company_name')" required autofocus autocomplete="certified_by_company_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('certified_by_company_name')" />
                            </div>

                            <!-- Certified For -->
                            <div>
                                <x-input-label for="certified_for" :value="__('Certified For')" />
                                <x-text-input id="certified_for" name="certified_for" type="text" class="mt-1 block w-full" :value="old('certified_for')" required autofocus autocomplete="certified_for" />
                                <x-input-error class="mt-2" :messages="$errors->get('certified_for')" />
                            </div>

                            <!-- Product Name -->
                            <div>
                                <x-input-label for="product_name" :value="__('Product Name')" />
                                <x-text-input id="product_name" name="product_name" type="text" class="mt-1 block w-full" :value="old('product_name')" required autofocus autocomplete="product_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('certificate.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
