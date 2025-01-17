<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  text-text leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-component shadow sm:rounded-lg">
                    <div class="flex gap-2 max-w-xl  ">
                        <button onclick="switchTheme('theme-light')" class="bg-gray-300 text-black p-2 rounded">Light Mode</button>
                        <button onclick="switchTheme('theme-dark')" class="bg-gray-800 text-[#ffffff] p-2 rounded">Dark Mode</button>
                        <button onclick="switchTheme('theme-blue')" class="bg-blue-500 text-white p-2 rounded">Blue Theme</button>
                        <button onclick="switchTheme('theme-green')" class="bg-green-500 text-white p-2 rounded">Green Theme</button>
                        <button onclick="switchTheme('theme-purple')" class="bg-purple-500 text-white p-2 rounded">Purple Theme</button>
                    </div>
            </div>
            <div class="p-4 sm:p-8 bg-component shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-component shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-component  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
