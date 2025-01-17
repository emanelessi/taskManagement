<x-guest-layout>
        <h6 class="text-2xl font-bold text-center mb-6 text-text  ">
            {{ __('Login to Your Account')}}</h6>
       <x-auth-session-status class="mb-4" :status="session('status')" />

       <form class="space-y-4" method="POST" action="{{ route('login') }}" >
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"  />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="relative">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="flex justify-between items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded  border-gray-300  text-text shadow-sm focus:ring-indigo-500  " name="remember">
                    <span class="ms-2 text-sm text-text">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-text hover:text-hover   rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  " href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

            </div>

            <x-primary-button  class="justify-center items-center w-full flex">
                {{ __('Log in') }}
            </x-primary-button>
        </form>

        <div class="mt-6 text-center">
            <p class="border-gray-300  text-hover  focus:border-indigo-500   focus:ring-indigo-500  rounded-md shadow-sm">{{__("Don't have an account?")}}
                    <a href="{{ route('register') }}"  class="text-text hover:underline">{{__('Sign up')}}</a>
            </p>
        </div>

</x-guest-layout>
