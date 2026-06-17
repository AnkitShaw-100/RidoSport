<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product  Card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Product Card') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('product_card.update', $productCards->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            <!-- Product Card Title -->
                            <div>
                                <x-input-label for="product_card_title" :value="__('Product Card Title')" />
                                <x-text-input id="product_card_title" name="product_card_title" type="text" class="mt-1 block w-full" :value="old('product_card_title', $productCards->product_card_title)" required autofocus autocomplete="product_card_title" />
                                <x-input-error class="mt-2" :messages="$errors->get('product_card_title')" />
                            </div>

                            <!-- Product Card Description -->
                            <div>
                                <x-input-label for="product_card_description" :value="__('Product Card Description')" />
                                <x-text-input id="product_card_description" name="product_card_description" type="text" class="mt-1 block w-full" :value="old('product_card_description', $productCards->product_card_description)" required autofocus autocomplete="product_card_description" />
                                    <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Length upto 350 Character</p>
                                <x-input-error class="mt-2" :messages="$errors->get('product_card_description')" />
                            </div>

                            <!-- Current Product Card Image -->
                            <div class="mt-4">
                                <x-input-label for="product_card_image" :value="__('Current Product Card Image')" />
                                <img src="{{ url($productCards->product_card_image) }}" alt="Product Card Image" style="width:300px; height:auto;">
                            </div>

                            <!-- Product Card Image (Image Upload) -->
                            <div class="mt-4">
                                <x-input-label for="product_card_image" :value="__('Change Product Card Image (Optional)')" />
                                <input type="file" name="product_card_image" id="product_card_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">File Size upto 20MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('product_card_image')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('product_card.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
