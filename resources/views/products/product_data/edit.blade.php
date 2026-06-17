








<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Product') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update the necessary details for the product.") }}
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

                        <!-- Product Edit Form -->
                        <form method="POST" action="{{ route('product-data.update', $product->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <!-- SubProduct Selection -->
                            <div>
                                <x-input-label for="subproduct_id" :value="__('SubProduct')" />
                                <select name="subproduct_id" id="subproduct_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                                    <option value="">Select SubProduct</option>
                                    @foreach ($subproducts as $subproduct)
                                        <option value="{{ $subproduct->id }}" {{ $product->subproduct_id == $subproduct->id ? 'selected' : '' }}>
                                            {{ $subproduct->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('subproduct_id')" />
                            </div>

                            <!-- Product Name -->
                            <div>
                                <x-input-label for="name" :value="__('Product Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required value="{{ old('name', $product->name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                             <!-- Current Product Image -->
                             <div class="mt-4">
                                <x-input-label for="product_image" :value="__('Current Product Image')" />
                                <img src="{{ url($product->image) }}" alt="Product Image" style="width:300px; height:auto;">
                            </div>
                            <div>
                                <x-input-label for="image" :value="__('Main Product Image')" />
                                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Leave blank to keep the current image.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                            
                            <!-- Product Description -->
                            <div>
                                <x-input-label for="description" :value="__('Product Description')" />
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required cols="30" rows="5">{{ old('description', $product->description) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Technical Details -->
    <div>
        <x-input-label for="thickness" :value="__('Thickness')" />
        <x-text-input id="thickness" name="technical_details[thickness]" type="text" class="mt-1 block w-full" required value="{{ old('technical_details.thickness', $product->technical_details['thickness'] ?? '') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('technical_details.thickness')" />
    </div>

    <div>
        <x-input-label for="material" :value="__('Material')" />
        <x-text-input id="material" name="technical_details[material]" type="text" class="mt-1 block w-full" required value="{{ old('technical_details.material', $product->technical_details['material'] ?? '') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('technical_details.material')" />
    </div>

    <div>
        <x-input-label for="surface_type" :value="__('Surface Type')" />
        <x-text-input id="surface_type" name="technical_details[surface_type]" type="text" class="mt-1 block w-full" required value="{{ old('technical_details.surface_type', $product->technical_details['surface_type'] ?? '') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('technical_details.surface_type')" />
    </div>

                            <!-- Advantages -->
                            <div>
                                <x-input-label for="advantages" :value="__('Advantages')" />
                                <div id="advantages_fields">
                                    @foreach (old('advantages', $product->advantages) as $index => $advantage)
                                        <div id="advantage-{{ $index }}" class="mt-1 flex items-center space-x-2">
                                            <x-text-input name="advantages[]" type="text" class="block w-full" required value="{{ $advantage }}" />
                                            <button type="button" class="remove-advantage btn btn-danger" data-index="{{ $index }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-advantage" class="btn btn-secondary mt-2">Add More Advantages</button>
                            </div>

                            <!-- Colors -->
<div id="color_options_container">
    <x-input-label for="colors" :value="__('Available Colors')" />
    <div id="color_fields">
        @foreach (old('colors', $product->colors) as $index => $color)
            <div id="color-{{ $index }}" class="flex items-center space-x-4 mt-2">
                <x-text-input name="colors[{{ $index }}][key]" type="text" placeholder="Color Name (e.g., Red)" class="block w-1/3" required value="{{ $color['key'] }}" />
                <x-text-input type="text" name="colors[{{ $index }}][value]" class="block w-1/3" required placeholder="Color Code (#00FF00)" value="{{ $color['value'] }}" />
                <button type="button" class="remove-color btn btn-danger" data-index="{{ $index }}">Remove</button>
            </div>
        @endforeach
    </div>
    <button type="button" id="add-color" class="btn btn-secondary mt-2">Add More Colors</button>
</div>

    <!-- Why Choose Us -->
    <div>
        <x-input-label for="why_choose" :value="__('Why Choose Us')" />
        <div id="why_choose_fields">
            @foreach (old('why_choose', is_array($product->why_choose) ? $product->why_choose : json_decode($product->why_choose, true) ?? []) as $index => $choose)
                <div id="why_choose-{{ $index }}" class="mt-1 flex space-x-2 items-center">
                    <x-text-input name="why_choose[{{ $index }}][key]" type="text" placeholder="Key (e.g., Durability)" class="block w-1/3" required value="{{ $choose['key'] }}" />
                    <x-text-input name="why_choose[{{ $index }}][value]" type="text" placeholder="Description (e.g., The product is highly durable...)" class="block w-full" required value="{{ $choose['value'] }}" />
                    <button type="button" class="remove-why_choose btn btn-danger" data-index="{{ $index }}">Remove</button>
                </div>
            @endforeach

        </div>
        <button type="button" id="add-why_choose" class="btn btn-secondary mt-2">Add More Reasons</button>
    </div>

                            <!-- Product Images -->


                            <!-- Current Product Images -->
                            <div class="mt-4">
                                <x-input-label for="current-images" :value="__('Current Product Gallery Images')" />
                                <div class="d-flex flex-wrap gap-2"> <!-- Flex container for inline display -->
                                    @foreach(json_decode($product->gallery_images, true) as $imgIndex => $image)
                                        <div class="position-relative">
                                            <a href="{{ url($image) }}" target="_blank">
                                                <img src="{{ url($image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                            </a>
                                            <!-- Add checkbox for image deletion -->
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="delete_images[]" value="{{ $image }}">
                                                    {{ __('Delete') }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Select images to delete.</p>
                            </div>

                            <div>
                                <x-input-label for="gallery_images" :value="__('Gallery Images')" />

                                <input type="file" name="gallery_images[]" id="gallery_images" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" multiple />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">Leave blank to keep the current images.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('gallery_images')" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update Product') }}</x-primary-button>
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
            var advantageIndex = {{ 
                is_array(old('advantages')) 
                    ? count(old('advantages')) 
                    : (is_array($product->advantages) 
                        ? count($product->advantages) 
                        : (is_string($product->advantages) ? count(json_decode($product->advantages, true)) : 0)) 
            }}; 

            let colorIndex = {{ 
                is_array(old('colors')) 
                    ? count(old('colors')) 
                    : (is_array($product->colors) 
                        ? count($product->colors) 
                        : (is_string($product->colors) ? count(json_decode($product->colors, true)) : 0)) 
            }}; 

            let whyChooseIndex = {{ 
                is_array(old('why_choose')) 
                    ? count(old('why_choose')) 
                    : (is_array($product->why_choose) 
                        ? count($product->why_choose) 
                        : (is_string($product->why_choose) ? count(json_decode($product->why_choose, true)) : 0)) 
            }}; 

            // Add new Why Choose key-value pair
            $('#add-why_choose').click(function() {
                whyChooseIndex++; // Increment the index for the new field
                $('#why_choose_fields').append(`
                    <div id="why_choose-${whyChooseIndex}" class="mt-2 flex items-center space-x-2">
                        <x-text-input name="why_choose[${whyChooseIndex}][key]" type="text" placeholder="Key (e.g., Durability)" class="block w-1/3" required />
                        <x-text-input name="why_choose[${whyChooseIndex}][value]" type="text" placeholder="Description (e.g., The product is highly durable...)" class="block w-full" required />
                        <button type="button" class="remove-why_choose btn btn-danger" data-index="${whyChooseIndex}">Remove</button>
                    </div>
                `);
            });

            // Function to add new color fields
            $('#add-color').click(function() {
                colorIndex++; // Increment for new color
                $('#color_fields').append(`
                    <div id="color-${colorIndex}" class="flex items-center space-x-4 mt-2">
                        <x-text-input name="colors[${colorIndex}][key]" type="text" placeholder="Color Name (e.g., Red)" class="block w-1/3" required />
                        <x-text-input type="text" name="colors[${colorIndex}][value]" class="block w-1/3" required placeholder="Color Code (#00FF00)" />
                        <button type="button" class="remove-color btn btn-danger" data-index="${colorIndex}">Remove</button>
                    </div>
                `);
            });

            // Remove existing color field
            $(document).on('click', '.remove-color', function() {
                const index = $(this).data('index');
                $(`#color-${index}`).remove(); // Remove the specific field
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

            $(document).on('click', '.remove-why_choose', function() {
                const index = $(this).data('index');
                $(`#why_choose-${index}`).remove(); // Remove the specific field
                // Optionally, you can re-index the remaining fields if you want to keep them in order
            });



        });
    </script>
    @endpush
</x-app-layout>



