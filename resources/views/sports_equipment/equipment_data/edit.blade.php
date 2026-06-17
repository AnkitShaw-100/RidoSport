<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Equipment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Equipment') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('equipment-data.update', $equipment->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            {{-- @method('PUT') <!-- This is important for RESTful update --> --}}

                            <!-- Sports Equipment Listing Name Selection -->
                            <div>
                                <x-input-label for="sportsEquipment_id" :value="__('Sports Equipment Listing Name')" />
                                <select name="sports_equipment_id" id="sportsEquipment_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                                    <option value="">Select Sports Equipment Listing Name</option>
                                    @foreach ($sportsEquipment as $item)
                                        <option value="{{ $item->id }}" {{ $equipment->sports_equipment_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('sports_equipment_id')" />
                            </div>
                        
                            <!-- Equipment Name -->
                            <div>
                                <x-input-label for="name" :value="__('Equipment Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" value="{{ old('name', $equipment->name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        
                            <!-- Equipment Description -->
                            <div>
                                <x-input-label for="description" :value="__('Equipment Description')" />
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required cols="30" rows="5">{{ old('description', $equipment->description) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        
                            <!-- Current Equipment Image -->
                            <div>
                                <x-input-label for="current_image" :value="__('Current Equipment Image')" />
                                <div class="mt-1">
                                    @if($equipment->image)
                                        <img src="{{ asset($equipment->image) }}" alt="Current Equipment Image" class="h-32 w-32 object-cover rounded-md" style="width:300px; height:auto;">
                                    @else
                                        <p class="text-gray-600">No image available.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Equipment Image Upload -->
                            <div>
                                <x-input-label for="images" :value="__('Upload New Equipment Image')" />
                                <input type="file" name="image" id="images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Upload a new image (optional).</p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                        
                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update Equipment') }}</x-primary-button>
                                <a href="{{ route('equipment-data.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
