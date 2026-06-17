<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Display Success Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Display Failure/Error Message --}}
                    @if (session('failure'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('failure') }}</span>
                        </div>
                    @endif

                    <a href="{{ route('product-list.create') }}" class="btn btn-primary mb-4">Add New Product List</a>

                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">#</th>

                                <th class="border px-4 py-2">Product Name</th>
                                <th class="border px-4 py-2">Slug</th>
                                <th class="border px-4 py-2">URL</th>
                                <th class="border px-4 py-2">Sub Products</th>

                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td class="border px-4 py-2">{{ $index+1}}</td>
                                    
                                    <td class="border px-4 py-2">{{ $product->name }}</td>
                                    <td class="border px-4 py-2">{{ $product->slug }}</td>
                                    <td class="border px-4 py-2"><a href="{{ $product->url }}" class="text-blue-600 hover:underline">{{ $product->url }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($product->subProducts->count() > 0)
                                        
                                        <ol class="ml-4 mt-2 list-disc list-inside">
                                            @foreach ($product->subProducts as $subProduct)
                                                <li style="list-style-type: decimal">
                                                    <a href="{{ $subProduct->url }}" class="text-blue-600 hover:underline">{{ $subProduct->name }}</a>
                                                </li>
                                            @endforeach
                                        </ol>
                                            
                                    @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <!-- Action buttons for each service, like edit and delete -->
                                        <a href="{{ route('product-list.edit', $product->id) }}" class="text-blue-600 hover:underline btn btn-warning">
                                            <i class="fas fa-pencil"></i></a>
                                        <form action="{{ route('product-list.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white-600 hover:underline btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>

                               
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
