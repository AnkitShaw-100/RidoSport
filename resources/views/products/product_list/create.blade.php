<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Product') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Provide the necessary details for the new product list.') }}
                            </p>
                        </header>

                        <form action="{{ route('product-list.store') }}" method="POST" id="product-form" class="mt-6 space-y-6">
                            @csrf

                            <!-- Main Product Name -->
                            <div>
                                <x-input-label for="product-name" :value="__('Main Product Name')" />
                                <x-text-input id="product-name" name="product_name" type="text" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                            </div>

                            <!-- Custom Slug -->
                            <div>
                                <x-input-label for="product-slug" :value="__('Custom Slug (optional)')" />
                                <x-text-input id="product-slug" name="slug" type="text" class="mt-1 block w-full" placeholder="Leave empty to auto-generate" />
                                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                            </div>

                            <!-- Custom URL -->
                            <div>
                                <x-input-label for="product-url" :value="__('Custom URL (optional)')" />
                                <x-text-input id="product-url" name="url" type="text" class="mt-1 block w-full" placeholder="Leave empty to auto-generate from slug" />
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>

                            <!-- Sublist Items -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sublist Items (Optional)</label>
                                <button type="button" id="add-sublist-item" class="btn btn-secondary mt-2">Add Sublist Item</button>
                                <ul id="sublist-items" class="list-unstyled mt-2"></ul>
                                <x-input-error class="mt-2" :messages="$errors->get('sublist_items')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4 mt-4">
                                <x-primary-button>{{ __('Save Product') }}</x-primary-button>
                                <a href="{{ route('product-list.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        $(document).ready(function() {
            var sublistIndex = 0;

            $('#add-sublist-item').click(function() {
                sublistIndex++;
                $('#sublist-items').append(`
                    <li id="sublist-item-${sublistIndex}" class="mb-4">
                        <label for="sublist_items_${sublistIndex}_name" class="form-label">Sublist Name</label>
                        <x-text-input id="sublist_items_${sublistIndex}_name" name="sublist_items[${sublistIndex}][name]" type="text" placeholder="Sublist Name" class="mt-2 block w-full" required />

                        <label for="sublist_items_${sublistIndex}_slug" class="form-label">Sublist Slug (optional)</label>
                        <x-text-input id="sublist_items_${sublistIndex}_slug" name="sublist_items[${sublistIndex}][slug]" type="text" placeholder="Sublist Slug (optional)" class="mt-2 block w-full" />

                        <label for="sublist_items_${sublistIndex}_url" class="form-label">Sublist URL (optional)</label>
                        <x-text-input id="sublist_items_${sublistIndex}_url" name="sublist_items[${sublistIndex}][url]" type="text" placeholder="Sublist URL (optional)" class="mt-2 block w-full" />

                        <button type="button" class="remove-sublist-item btn btn-danger mt-2" data-index="${sublistIndex}">{{ __('Remove') }}</button>
                    </li>
                `);
            });

            $(document).on('click', '.remove-sublist-item', function() {
                var index = $(this).data('index');
                $(`#sublist-item-${index}`).remove();
            });
        });
    </script>
    @endpush
</x-app-layout>
