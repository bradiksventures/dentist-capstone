<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="first_name" :value="__('First Name')"/>
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                              :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name"/>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
            </div>
            <div>
                <x-input-label for="name" :value="__('Last Name')"/>
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                              :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name"/>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')"/>
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                          :value="old('address', $user->address)" required autofocus autocomplete="address"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2"/>
        </div>

        @if($user->profilable instanceof \App\Models\Dentist)
            <div class=" mt-4">
                <x-input-label for="dental_clinic_name" :value="__('Dental Clinic Name')"/>
                <x-text-input id="dental_clinic_name" class="block mt-1 w-full" type="text" name="dental_clinic_name"
                              :value="old('dental_clinic_name', $user->profilable->dental_clinic_name)" required autofocus autocomplete="dental_clinic_name"/>
                <x-input-error :messages="$errors->get('dental_clinic_name')" class="mt-2"/>
            </div>
            <div class="mt-4">
                <x-input-label for="prc_number" :value="__('PRC Number')"/>
                <x-text-input id="prc_number" class="block mt-1 w-full" type="text" name="prc_number"
                              :value="old('prc_number', $user->profilable->prc_number)" required autofocus autocomplete="prc_number"/>
                <x-input-error :messages="$errors->get('prc_number')" class="mt-2"/>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class="md:col-span-1">
                <x-input-label for="sex" :value="__('Gender')"/>
                <x-select
                    class="block mt-1 w-full"
                    name="sex"
                    :options="['' => '', 'male' => 'Male', 'female' => 'Female', 'others' => 'Others']"
                    :selected="old('sex', $user->sex)"
                />
                <x-input-error :messages="$errors->get('sex')" class="mt-2"/>
            </div>
            <div class="md:col-span-2 ">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)"
                              required autocomplete="username"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
