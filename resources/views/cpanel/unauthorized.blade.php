<x-app-layout>
    <div class="bg-white shadow-lg rounded-lg p-8 text-center">
        <h1 class="text-2xl font-bold mb-4 text-red-600">{{ __('Unauthorized') }}</h1>
        <p class="mb-6">{{ __('You do not have permission to access this page.') }}</p>
        <a href="{{ url('/dashboard') }}" class="bg-tertiary/80 hover:bg-tertiary text-white font-bold py-2 px-4 rounded">
            {{ __('Go Home') }}
        </a>
    </div>
</x-app-layout>
