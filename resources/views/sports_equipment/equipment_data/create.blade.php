<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Equipment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Equipment') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Provide the necessary details for the new equipment.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('equipment-data.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                        
                            <!-- Sports Equipment Listing Name Selection -->
                            <div>
                                <x-input-label for="sportsEquipment_id" :value="__('Sports Equipment Listing Name')" />
                                <select name="sportsEquipment_id" id="sportsEquipment_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                                    <option value="">Select Sports Equipment Listing Name</option>
                                    @foreach ($sportsEquipment as $sportsEquipment)
                                        <option value="{{ $sportsEquipment->id }}" {{ old('sportsEquipment_id') == $sportsEquipment->id ? 'selected' : '' }}>{{ $sportsEquipment->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('sportsEquipment_id')" />
                            </div>
                        
                            <!-- Equipment Name -->
                            <div>
                                <x-input-label for="name" :value="__('Equipment Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" value="{{ old('name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        
                            <!-- Equipment Description -->
                            <div>
                                <x-input-label for="description" :value="__('Equipment Description')" />
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required  cols="30" rows="5">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        
                            <!-- Equipment Image -->
                            <div>
                                <x-input-label for="images" :value="__('Equipment Image')" />
                                <input type="file" name="image" id="images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"  required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Upload image.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                        
                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create Equipment') }}</x-primary-button>
                                <a href="{{ route('equipment-data.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
