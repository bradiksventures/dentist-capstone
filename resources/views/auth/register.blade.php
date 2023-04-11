<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <input type="hidden" value="{{ $as }}" name="as">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="first_name" :value="__('First Name')"/>
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                              :value="old('first_name')" required autofocus autocomplete="first_name"/>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
            </div>
            <div>
                <x-input-label for="name" :value="__('Last Name')"/>
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                              :value="old('last_name')" required autofocus autocomplete="last_name"/>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')"/>
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                          :value="old('address')" required autofocus autocomplete="address"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2"/>
        </div>

        @if($as === 'dentist')
            <div class=" mt-4">
                <x-input-label for="dental_clinic_name" :value="__('Dental Clinic Name')"/>
                <x-text-input id="dental_clinic_name" class="block mt-1 w-full" type="text" name="dental_clinic_name"
                              :value="old('dental_clinic_name')" required autofocus autocomplete="dental_clinic_name"/>
                <x-input-error :messages="$errors->get('dental_clinic_name')" class="mt-2"/>
            </div>
            <div class="mt-4">
                <x-input-label for="prc_number" :value="__('PRC Number')"/>
                <x-text-input id="prc_number" class="block mt-1 w-full" type="text" name="prc_number"
                              :value="old('prc_number')" required autofocus autocomplete="prc_number"/>
                <x-input-error :messages="$errors->get('prc_number')" class="mt-2"/>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div class="md:col-span-1">
                <x-input-label for="sex" :value="__('Gender')"/>
                <x-select
                    class="block mt-1 w-full"
                    name="sex"
                    :options="['' => '', 'male' => 'Male', 'female' => 'Female', 'others' => 'Others']"
                    :selected="old('sex')"
                />
                <x-input-error :messages="$errors->get('sex')" class="mt-2"/>
            </div>
            <div class="md:col-span-2 ">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                              required autocomplete="username"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
