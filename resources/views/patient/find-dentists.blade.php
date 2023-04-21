<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('Find Dentists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div x-data="{
                    search: '',
                    results: [],
                    loading: false,
                    searchDentists () {
                        if (this.search.trim() !== '') {
                            this.loading = true;
                            axios.get('/patient/do-find-dentists', {
                                params: { query: this.search }
                            }).then(response => {
                                this.results = response.data.map(i => ({
                                    name: this.highlight(i.profile.full_name),
                                    clinic_name: this.highlight(i.dental_clinic_name),
                                    address: this.highlight(i.profile.address),
                                    id: i.id
                                }));
                               this.loading = false;
                            });
                        } else {
                            this.results = [];
                        }
                    },
                    highlight(text) {
                        return text.replace(new RegExp(`(${this.search})`, 'gi'), '<span class=\'bg-yellow-300\'>$1</span>');
                    }
                }">
                    <div class="flex items-center w-full mb-4">
                        <input x-model="search" x-on:input.debounce.500ms="searchDentists()"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                               type="text" placeholder="Search dentists...">
                    </div>

                    <div x-show="loading" class="my-2">
                        <p class="text-gray-600">Loading...</p>
                    </div>

                    <table class="mt-6 w-full border-collapse border-2 border-gray-200 shadow-sm"
                           x-show="!loading && results.length">
                        <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 border-b-2 border-gray-200">Dentist Name</th>
                            <th class="px-4 py-2 border-b-2 border-gray-200">Dental Clinic</th>
                            <th class="px-4 py-2 border-b-2 border-gray-200">Address</th>
                            <th class="px-4 py-2 border-b-2 border-gray-200"></th>

                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="({name, clinic_name, address, id}) in results">
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b border-gray-200" x-html="name"></td>
                                <td class="px-4 py-2 border-b border-gray-200" x-html="clinic_name"></td>
                                <td class="px-4 py-2 border-b border-gray-200" x-html="address"></td>
                                <td class="px-4 py-2 border-b border-gray-200">
                                    <a x-bind:href="`/patient/view-dentist-profile/${id}`"
                                       class="text-gray-500 hover:text-gray-700 ">View Profile</a>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>

                    <div x-show="!loading && !results.length && search.trim() !== ''" class="my-2">
                        <p class="text-gray-600">No results found.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
