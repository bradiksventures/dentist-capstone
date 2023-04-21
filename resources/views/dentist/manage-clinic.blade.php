<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('My Clinic') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 grid md:grid-cols-2 ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('dentist.partials.update-dentist-services')
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('dentist.partials.update-dentist-availability')
            </div>
        </div>
    </div>
</x-app-layout>
