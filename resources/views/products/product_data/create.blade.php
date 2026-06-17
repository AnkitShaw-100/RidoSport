<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
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
                                {{ __("Provide the necessary details for the new product.") }}
                            </p>
                        </header>

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Product Creation Form -->
                        <form method="POST" action="{{ route('product-data.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <!-- SubProduct Selection -->
                            <div>
                                <x-input-label for="subproduct_id" :value="__('SubProduct')" />
                                <select name="subproduct_id" id="subproduct_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                                    <option value="">Select SubProduct</option>
                                    @foreach ($subproducts as $subproduct)
                                        <option value="{{ $subproduct->id }}" {{ old('subproduct_id') == $subproduct->id ? 'selected' : '' }}>
                                            {{ $subproduct->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('subproduct_id')" />
                            </div>

                            <!-- Product Name -->
                            <div>
                                <x-input-label for="name" :value="__('Product Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" value="{{ old('name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Product Description -->
                            <div>
                                <x-input-label for="description" :value="__('Product Description')" />
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required cols="30" rows="5">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Technical Details -->
    <div>
        <x-input-label for="thickness" :value="__('Thickness')" />
        <x-text-input id="thickness" name="technical_details[thickness]" type="text" class="mt-1 block w-full" required value="{{ old('technical_details.thickness') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('technical_details.thickness')" />
    </div>

    <div>
        <x-input-label for="material" :value="__('Material')" />
        <x-text-input id="material" name="technical_details[material]" type="text" class="mt-1 block w-full" required value="{{ old('technical_details.material') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('technical_details.material')" />
    </div>

    <div>
        <x-input-label for="surface_type" :value="__('Surface Type')" />
        <x-text-input id="surface_type" name="technical_details[surface_type]" type="text" class="mt-1 block w-full" required value="{{ old('technical_details.surface_type') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('technical_details.surface_type')" />
    </div>

                            <!-- Advantages (Dynamic Input Fields) -->
                            <div>
                                <x-input-label for="advantages" :value="__('Advantages')" />
                                <div id="advantages_fields">
                                    <div class="mt-1 flex items-center space-x-2">
                                        <x-text-input name="advantages[]" type="text" class="block w-full" required />
                                    </div>
                                </div>
                                <button type="button" id="add-advantage" class="btn btn-secondary mt-2">Add More Advantages</button>
                            </div>

                            

                            <!-- Colors (Dynamic Key-Value Pairs) -->
    <div id="color_options_container">
        <x-input-label for="colors" :value="__('Available Colors')" />
        <div id="color_fields">
            <div id="color-0" class="flex items-center space-x-4 mt-2">
                <x-text-input name="colors[0][key]" type="text" placeholder="Color Name (e.g., Red)" class="block w-1/3" required />
                <x-text-input type="text" name="colors[0][value]" class="block w-1/3" required placeholder="Color Code (#00FF00)" />
                
            </div>
        </div>
        <button type="button" id="add-color" class="btn btn-secondary mt-2">Add More Colors</button>
    </div>
                            

                            <!-- Why Choose Us (Dynamic Key-Value Pairs) -->
    <div>
        <x-input-label for="why_choose" :value="__('Why Choose Us')" />
        <div id="why_choose_fields">
            <div class="mt-1 flex space-x-2 items-center"  id="why_choose-0">

                <x-text-input name="why_choose[0][key]" type="text" placeholder="Key (e.g., Durability)" class="block w-1/3" required />
                <x-text-input name="why_choose[0][value]" type="text" placeholder="Description (e.g., The product is highly durable...)" class="block w-full" required />
            </div>
        </div>
        <button type="button" id="add-why_choose" class="btn btn-secondary mt-2">Add More Reasons</button>
    </div>

                            <!-- Product Images -->
                            <div>
                                <x-input-label for="image" :value="__('Main Product Image')" />
                                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div>
                                <x-input-label for="gallery_images" :value="__('Gallery Images')" />
                                <input type="file" name="gallery_images[]" id="gallery_images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" multiple required />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">You can upload multiple images for the gallery.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('gallery_images')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create Product') }}</x-primary-button>
                                <a href="{{ route('product-data.index') }}" class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ __('Cancel') }}</a>
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
            let whyChooseIndex = 0;
            var advantageIndex = 0;
            let colorIndex = 0;


            // Add new Color key-value pair
        $('#add-color').click(function() {
            colorIndex++;
            $('#color_fields').append(`
                <div id="color-${colorIndex}" class="mt-2 flex items-center space-x-4">
                    <x-text-input name="colors[${colorIndex}][key]" type="text" placeholder="Color Name (e.g., Red)" class="block w-1/3" required />
                    <x-text-input type="text" name="colors[${colorIndex}][value]" class="block w-1/3" required placeholder="Color Code (#00FF00)" />
                    <button type="button" class="remove-color btn btn-danger" data-index="${colorIndex}">Remove</button>
                </div>
            `);
        });

        // Remove dynamic color fields
        $(document).on('click', '.remove-color', function() {
            const index = $(this).data('index');
            $(`#color-${index}`).remove();
        });
            // Add new Why Choose key-value pair
            $('#add-why_choose').click(function() {
                whyChooseIndex++;
                $('#why_choose_fields').append(`
                    <div id="why_choose-${whyChooseIndex}" class="mt-2 flex items-center space-x-2">
                        <x-text-input name="why_choose[${whyChooseIndex}][key]" type="text" placeholder="Key (e.g., Durability)" class="block w-1/3" required />
                        <x-text-input name="why_choose[${whyChooseIndex}][value]" type="text" placeholder="Description (e.g., The product is highly durable...)" class="block w-full" required />
                        <button type="button" class="remove-why_choose btn btn-danger" data-index="${whyChooseIndex}">Remove</button>
                    </div>
                `);
            });
            

                    // Add new Advantage field
        $('#add-advantage').click(function() {
            advantageIndex++;
            $('#advantages_fields').append(`
                <div id="advantage-${advantageIndex}" class="mt-2 flex items-center space-x-2">
                    <x-text-input type="text" name="advantages[]" class="mt-1 block w-full" required />
                    <button type="button" class="remove-advantage btn btn-danger" data-index="${advantageIndex}">Remove</button>
                </div>
            `);
        });

        // Remove an existing Advantage field
        $(document).on('click', '.remove-advantage', function() {
            var index = $(this).data('index');
            $(`#advantage-${index}`).remove();
        });

            // Remove dynamic fields
            $(document).on('click', '.remove-why_choose', function() {
                const index = $(this).data('index');
                $(`#why_choose-${index}`).remove();
            });

            
        });
    </script>
    @endpush
</x-app-layout>
