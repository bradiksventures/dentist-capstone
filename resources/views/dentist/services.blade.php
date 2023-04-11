<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('My Dental Services') }}
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Add Service
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-md">
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Label</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-gray-100">
                            <td class="px-4 py-2">Filling</td>
                            <td class="px-4 py-2">Dental Filling</td>
                            <td class="px-4 py-2">$150</td>
                            <td class="px-4 py-2">
                                <x-secondary-button>
                                    Edit
                                </x-secondary-button>
                                <x-secondary-button>
                                    Delete
                                </x-secondary-button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-4 py-2">Cleaning</td>
                            <td class="px-4 py-2">Teeth Cleaning</td>
                            <td class="px-4 py-2">$100</td>
                            <td class="px-4 py-2">
                                <x-secondary-button>
                                    Edit
                                </x-secondary-button>
                                <x-secondary-button>
                                    Delete
                                </x-secondary-button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
