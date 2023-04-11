<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-md">
                <div class="p-4">
                    <form class="flex items-center">
                        <label for="name" class="mr-2">Name:</label>
                        <input type="text" name="name" id="name" placeholder="Search by name" class="border border-gray-300 rounded py-2 px-4 mr-4">

                        <label for="services" class="mr-2">Services:</label>
                        <x-select
                            class="mr-4"
                            name="sex"
                            :options="['' => 'All', 'cleaning' => 'Cleaning', 'filling' => 'Filling']"
                        />

                        <label for="services" class="mr-2">Status:</label>
                        <x-select
                            class="mr-4"
                            name="sex"
                            :options="['' => 'All', 'cleaning' => 'Completed', 'filling' => 'Pending']"
                        />

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                    </form>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Patient Name</th>
                            <th class="px-4 py-2 text-left">Start</th>
                            <th class="px-4 py-2 text-left">End</th>
                            <th class="px-4 py-2 text-left">Services</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-gray-100">
                            <td class="px-4 py-2">John Doe</td>
                            <td class="px-4 py-2">2023-04-12 10:00</td>
                            <td class="px-4 py-2">2023-04-12 11:00</td>
                            <td class="px-4 py-2">Cleaning, Filling</td>
                            <td class="px-4 py-2">Completed</td>
                            <td class="px-4 py-2">
                                <x-secondary-button>
                                    Cancel
                                </x-secondary-button>
                                <x-secondary-button>
                                    Add Rx
                                </x-secondary-button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-4 py-2">Jane Smith</td>
                            <td class="px-4 py-2">2023-04-12 14:00</td>
                            <td class="px-4 py-2">2023-04-12 15:00</td>
                            <td class="px-4 py-2">Whitening</td>
                            <td class="px-4 py-2">Pending</td>
                            <td class="px-4 py-2">
                                <x-secondary-button>
                                    Cancel
                                </x-secondary-button>
                                <x-secondary-button>
                                    Add Rx
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
