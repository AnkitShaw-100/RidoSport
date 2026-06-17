<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service List') }}
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

                    <a href="{{ route('service-list.create') }}" class="btn btn-primary mb-4">Add New Service</a>

                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Service Name</th>
                                <th class="border px-4 py-2">Slug</th>
                                <th class="border px-4 py-2">URL</th>
                                <th class="border px-4 py-2">Sub Services</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $index  =>$service)
                                <tr>
                                    <td class="border px-4 py-2">{{$index+1}}</td>
                                    <td class="border px-4 py-2">{{ $service->name }}</td>
                                    <td class="border px-4 py-2">{{ $service->slug }}</td>
                                    <td class="border px-4 py-2">{{ $service->url }}</td>
                                    <td class="border px-4 py-2"> 
                                        @if ($service->subServices->count() > 0)
                                            <ol class="ml-4 mt-2 list-disc list-inside">

                                                @foreach ($service->subServices as $subService)
                                                <li style="list-style-type:decimal">
                                                    <a href="{{ $subService->url }}" class="text-blue-600 hover:underline">{{ $subService->name }}</a>
                                                </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <!-- Action buttons for each service, like edit and delete -->
                                        <a href="{{ route('service-list.edit', $service->id) }}" class="text-white-600 hover:underline btn btn-warning">
                                            <i class="fas fa-pencil"></i></a>
                                        <form action="{{ route('service-list.destroy', $service->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white-600 hover:underline btn btn-danger"><i class="fas fa-trash-alt"></i>
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
