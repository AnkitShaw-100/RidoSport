<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sports Equipment List') }}
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

                    <a href="{{ route('sports-equipment-list.create') }}" class="btn btn-primary mb-4">Add New Sports Equipment List</a>

                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Sports Equipment Name</th>
                                <th class="border px-4 py-2">Slug</th>
                                <th class="border px-4 py-2">URL</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sports_equipment_list as $index => $list)
                                <tr>
                                    <td class="border px-4 py-2">{{$index+1}}</td>
                                    <td class="border px-4 py-2">{{ $list->name }}</td>
                                    <td class="border px-4 py-2">{{ $list->slug }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ $list->url }}" class="text-blue-600 hover:underline">{{ $list->url }}</a>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <!-- Action buttons for each list, like edit and delete -->
                                        <a href="{{ route('sports-equipment-list.edit', $list->id) }}" class="text-blue-600 hover:underline btn  btn-warning">
                                            <i class="fas fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('sports-equipment-list.destroy', $list->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hover:underline btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            
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
