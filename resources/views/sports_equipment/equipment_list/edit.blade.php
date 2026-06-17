<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sports Equipment List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Sports Equipment List') }} : {{ $sports_equipment_list->name }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('sports-equipment-list.update', $sports_equipment_list->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            {{-- @method('PUT') <!-- Use PUT for updates --> --}}

                            <!-- Sports Equipment Name -->
                            <div>
                                <x-input-label for="name" :value="__('Sports Equipment Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $sports_equipment_list->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Custom Slug -->
                            <div>
                                <x-input-label for="slug" :value="__('Custom Slug (optional)')" />
                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $sports_equipment_list->slug)" placeholder="Leave empty to auto-generate" />
                                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                            </div>

                            <!-- Custom URL -->
                            <div>
                                <x-input-label for="url" :value="__('Custom URL (optional)')" />
                                <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', $sports_equipment_list->url)" placeholder="Leave empty to auto-generate from slug" />
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>

                            <!-- Save Button and Cancel -->
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('sports-equipment-list.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
