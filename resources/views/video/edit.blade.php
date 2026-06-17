<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Video') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('video.update', $video->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            <!-- Caption Field -->
                            <div>
                                <x-input-label for="caption" :value="__('Caption')" />
                                <x-text-input 
                                    id="caption" 
                                    name="caption" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    :value="old('caption', $video->caption)" 
                                    
                                    autofocus 
                                    autocomplete="caption" 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('caption')" />
                            </div>
                        
                            <div class="embed-responsive bg-white border rounded-lg shadow-sm">
                                <iframe src="https://www.youtube.com/embed/{{ $video->url }}" 
                                    class="embed-responsive-item rounded w-full"  
                                    frameborder="0" 
                                    style="height: 500px;" <!-- Adjust height as needed -->
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            
                        
                            <!-- Video URL Input -->
                            <div class="mt-4">
                                <x-input-label for="url" :value="__('Video Url (Optional)')" />
                                <input 
                                    type="text" 
                                    name="url" 
                                    id="url" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" 
                                    placeholder="Enter new YouTube video URL if changing" 
                                    value="{{ old('url') }}"
                                />
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">YouTube Video URL</p>
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>
                        
                            <!-- Form Actions -->
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a 
                                    href="{{ route('video.index') }}" 
                                    class="inline-block px-4 py-2 text-sm font-semibold text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
