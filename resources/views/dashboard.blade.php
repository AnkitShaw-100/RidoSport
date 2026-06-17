<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div id="welcome-message" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome to the Home Page!") }}
                </div> --}}
            </div>

            <!-- Tab Navigation -->
            <div class="mt-8">
                <div class="tabs">
                    <button class="tab active" onclick="showTab('contact')">Contact Queries</button>
                    <button class="tab" onclick="showTab('court')">Court Queries</button>
                </div>

                <!-- Contact Queries Section -->
                <div id="contact" class="tab-content active">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Contact Queries</h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-black mt-4">
                            <thead>
                                <tr class="border-b border-black">
                                    <th class="p-2 border-r border-black">#</th>
                                    <th class="p-2 border-r border-black">Name</th>
                                    <th class="p-2 border-r border-black">Email</th>
                                    <th class="p-2 border-r border-black">Phone</th>
                                    <th class="p-2 border-r border-black">Message</th>
                                    <th class="p-2 border-r border-black">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactQueries as $index => $query)
                                    <tr class="border-b border-black">
                                        <td class="p-2 border-r border-black">{{ $index + 1 }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->name }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->email }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->phone }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->message }}</td>
                                        <td class="p-2 border-r border-black">
                                            <form action="{{ route('contact.destroy', $query->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($contactQueries->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400 mt-4">No contact queries available.</p>
                    @endif
                    {{ $contactQueries->links() }}
                </div>

                <!-- Court Queries Section -->
                <div id="court" class="tab-content" style="display: none;">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Court Queries</h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-black mt-4">
                            <thead>
                                <tr class="border-b border-black">
                                    <th class="p-2 border-r border-black">#</th>
                                    <th class="p-2 border-r border-black">Name</th>
                                    <th class="p-2 border-r border-black">Email</th>
                                    <th class="p-2 border-r border-black">Phone</th>
                                    <th class="p-2 border-r border-black">Court</th>
                                    <th class="p-2 border-r border-black">Requirement</th>
                                    <th class="p-2 border-r border-black">City</th>
                                    <th class="p-2 border-r border-black">Message</th>
                                    <th class="p-2 border-r border-black">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courtQueries as $index => $query)
                                    <tr class="border-b border-black">
                                        <td class="p-2 border-r border-black">{{ $index + 1 }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->name }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->email }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->phone }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->court }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->requirement }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->city }}</td>
                                        <td class="p-2 border-r border-black">{{ $query->message }}</td>
                                        <td class="p-2 border-r border-black">
                                            <form action="{{ route('court-query.destroy', $query->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($courtQueries->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400 mt-4">No court queries available.</p>
                    @endif
                    {{ $courtQueries->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Functionality -->
    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.style.display = 'none';
            });

            // Remove active class from all tabs
            const tabButtons = document.querySelectorAll('.tab');
            tabButtons.forEach(tabButton => {
                tabButton.classList.remove('active');
            });

            // Show the selected tab and set it as active
            document.getElementById(tabName).style.display = 'block';
            event.currentTarget.classList.add('active');
        }
    </script>

    <style>
        /* Basic styles for the tab buttons */
        .tabs {
            display: flex;
            margin-bottom: 1rem;
        }
        .tab {
            background-color: #f3f4f6; /* Light gray */
            border: 1px solid #ddd; /* Gray border */
            border-radius: 0.375rem; /* Rounded corners */
            padding: 0.5rem 1rem; /* Spacing */
            cursor: pointer;
            margin-right: 0.5rem; /* Space between tabs */
            transition: background-color 0.3s;
        }
        .tab:hover {
            background-color: #e5e7eb; /* Slightly darker on hover */
        }
        .tab.active {
            background-color: #e2e8f0; /* Light blue for active */
            border-bottom: 1px solid transparent; /* Hide bottom border for active */
        }
    </style>
</x-app-layout>
