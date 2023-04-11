<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
        @if(session()->get('registrationOk') === true)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Hurray!</strong>
                <span class="block sm:inline">You have successfully registered. You may now sign in.</span>
            </div>
        @endif


        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="flex flex-col my-4">
            <x-primary-button class="justify-center">
                {{ __('Log in') }}
            </x-primary-button>

            <label for="remember_me" class="inline-flex items-center mt-2">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

        </div>

            <div class="flex items-center justify-center mt-4 hidden">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <hr class="my-3">

            <div class="flex justify-center text-sm text-gray-600  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                No account yet? Register as
                <a class="underline mx-1 hover:text-gray-900 "
                   href="{{ route('register', ['as' => 'patient']) }}">
                    {{ __('patient') }}
                </a> or
                <a class="underline mx-1 hover:text-gray-900"
                   href="{{ route('register', ['as' => 'dentist']) }}">
                    {{ __('dentist') }}
                </a> now!
            </div>
    </form>
</x-guest-layout>
