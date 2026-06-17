<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Sports Equipment Name') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Sports Equipment Name') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Provide the necessary details for the new Sports Equipment.') }}
                            </p>
                        </header>

                        <form action="{{ route('sports-equipment-list.store') }}" method="POST" class="mt-6 space-y-6">
                            @csrf

                            <!-- Sports Equipment Name -->
                            <div>
                                <x-input-label for="name" :value="__('Sports Equipment Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required  :value="old('name')"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Custom Slug -->
                            <div>
                                <x-input-label for="slug" :value="__('Custom Slug (optional)')" />
                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" placeholder="Leave empty to auto-generate" :value="old('slug')" />
                                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                            </div>

                            <!-- Custom URL -->
                            <div>
                                <x-input-label for="url" :value="__('Custom URL (optional)')" />
                                <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" placeholder="Leave empty to auto-generate from slug" :value="old('url')" />
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>

                        
                            <!-- Form Actions -->
                            <div class="flex items-center gap-4 mt-4">
                                <x-primary-button>{{ __('Save Sports Equipment') }}</x-primary-button>
                                <a href="{{ route('sports-equipment-list.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
