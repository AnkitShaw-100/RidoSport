<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Project') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Provide the necessary details for the new project.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('project-data.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                        
                            <!-- SubService Selection -->
                            <div>
                                <x-input-label for="subservice_id" :value="__('SubService')" />
                                <select name="subservice_id" id="subservice_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                                    <option value="">Select SubService</option>
                                    @foreach ($subservices as $subservice)
                                        <option value="{{ $subservice->id }}" {{ old('subservice_id') == $subservice->id ? 'selected' : '' }}>{{ $subservice->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('subservice_id')" />
                            </div>
                        
                            <!-- Project Title -->
                            <div>
                                <x-input-label for="title" :value="__('Project Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" value="{{ old('title') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                        
                            <!-- Project Description -->
                            <div>
                                <x-input-label for="description" :value="__('Project Description')" />
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required  cols="30" rows="5">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        
                            <!-- Project Images -->
                            <div>
                                <x-input-label for="images" :value="__('Project Images')" />
                                <input type="file" name="images[]" id="images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" multiple required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">You can upload multiple images.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('images')" />
                            </div>
                        
                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create Project') }}</x-primary-button>
                                <a href="{{ route('project-data.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
