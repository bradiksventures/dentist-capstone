<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Patients') }}
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
                            <th class="px-4 py-2 text-left">Sex</th>
                            <th class="px-4 py-2 text-left">Birthday</th>
                            <th class="px-4 py-2 text-left">Last Appointment</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-gray-100">
                            <td class="px-4 py-2">John Doe</td>
                            <td class="px-4 py-2">Male</td>
                            <td class="px-4 py-2">1985-06-12</td>
                            <td class="px-4 py-2">2023-04-10</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-4 py-2">Jane Smith</td>
                            <td class="px-4 py-2">Female</td>
                            <td class="px-4 py-2">1990-11-23</td>
                            <td class="px-4 py-2">2023-04-08</td>
                        </tr>
                        <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>





        </div>
    </div>
</x-app-layout>
