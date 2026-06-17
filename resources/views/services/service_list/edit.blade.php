<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Service') }}: {{ $service->name }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('service-list.update', $service->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('POST') <!-- Change to PUT for updates -->

                            <!-- Main Service Name -->
                            <div>
                                <x-input-label for="service_name" :value="__('Main Service Name')" />
                                <x-text-input id="service_name" name="service_name" type="text" class="mt-1 block w-full" :value="old('service_name', $service->name)" required autofocus autocomplete="service_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('service_name')" />
                            </div>

                            <!-- Custom Slug -->
                            <div>
                                <x-input-label for="slug" :value="__('Custom Slug (optional)')" />
                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $service->slug)" placeholder="Leave empty to auto-generate" />
                                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                            </div>

                            <!-- Custom URL -->
                            <div>
                                <x-input-label for="url" :value="__('Custom URL (optional)')" />
                                <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', $service->url)" placeholder="Leave empty to auto-generate from slug" />
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>

                           <!-- Sublist Items -->
<div>
    <x-input-label :value="__('Sublist Items (Optional)')" />
    <button type="button" id="add-sublist-item" class="btn btn-secondary mt-2">{{ __('Add Sublist Item') }}</button>
    <ul id="sublist-items" class="list-unstyled mt-2 space-y-4">

        {{-- @foreach ($service->subServices as $subService)
            <li>
                <a href="{{ $subService->url }}" class="text-blue-600 hover:underline">{{ $subService->name }}</a>
            </li>
        @endforeach --}}
        @foreach ($service->subservices as $index => $subservice)
        <li id="sublist-item-{{ $index }}" class="mb-4">
            <!-- Hidden input to hold the ID of the subservice -->
            <input type="hidden" name="sublist_items[{{ $index }}][id]" value="{{ $subservice->id }}">

            <label for="sublist_items_{{ $index }}_name" class="form-label">Sublist Name</label>
            <x-text-input id="sublist_items_{{ $index }}_name" name="sublist_items[{{ $index }}][name]" type="text" placeholder="Sublist Name" class="mt-2 block w-full" value="{{ old('sublist_items.'.$index.'.name', $subservice->name) }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('sublist_items.'.$index.'.name')" />

            <label for="sublist_items_{{ $index }}_slug" class="form-label">Sublist Slug (optional)</label>
            <x-text-input id="sublist_items_{{ $index }}_slug" name="sublist_items[{{ $index }}][slug]" type="text" placeholder="Sublist Slug (optional)" class="mt-2 block w-full" value="{{ old('sublist_items.'.$index.'.slug', $subservice->slug) }}" />
            <x-input-error class="mt-2" :messages="$errors->get('sublist_items.'.$index.'.slug')" />

            <label for="sublist_items_{{ $index }}_url" class="form-label">Sublist URL (optional)</label>
            <x-text-input id="sublist_items_{{ $index }}_url" name="sublist_items[{{ $index }}][url]" type="text" placeholder="Sublist URL (optional)" class="mt-2 block w-full" value="{{ old('sublist_items.'.$index.'.url', $subservice->url) }}" />
            <x-input-error class="mt-2" :messages="$errors->get('sublist_items.'.$index.'.url')" />

            <button type="button" class="remove-sublist-item btn btn-danger mt-2" data-index="{{ $index }}">{{ __('Remove') }}</button>
        </li>
        @endforeach
    </ul>
</div>



                            <!-- Save Button and Cancel -->
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('service-list.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">{{ __('Cancel') }}</a>
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
            var sublistIndex = {{ count($subservices) }}; // Start index for new sublist items

            // Add new sublist item
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

            // Remove sublist item
            $(document).on('click', '.remove-sublist-item', function() {
                var index = $(this).data('index');
                $(`#sublist-item-${index}`).remove();
            });
        });
    </script>
    @endpush
</x-app-layout>



