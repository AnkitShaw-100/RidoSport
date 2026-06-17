<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home-Banner') }}
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

                    <a href="{{ route('home-banner.create') }}" class="btn btn-primary mb-4">Add New Banner</a>
                    {{-- <a href="" class="btn btn-primary mb-4">Add Banner</a> --}}

                    <table class="table-auto w-full border border-black">
                        <thead>
                            <tr class="border-b border-black">
                                <th class="p-2 border-r border-black">#</th>
                                <th class="p-2 border-r border-black">Tagline</th>
                                <th class="p-2 border-r border-black">Video</th>
                                <th class="p-2 border-r border-black">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banner as $index => $banner)
                                <tr class="border-b border-black">
                                    <td class="p-2 border-r border-black">{{ $index + 1 }}</td>
                                    <td class="p-2 border-r border-black">{{ $banner->tagline }}</td>
                                    
                                    <td class="p-2 border-r border-black">
                                        <video width="320" height="240" controls>
                                            <source src="{{ url('/' . $banner->video_url) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </td>
                                    
                                    <td class="p-2 border-r border-black">
                                        <a href="{{ route('home-banner.edit', $banner->id) }}" class="btn btn-warning">
                                            <i class="fas fa-pencil"></i></a>
                                        <form action="{{ route('home-banner.destroy', $banner->id) }}" method="POST" style="display: inline-block;"> 
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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
