@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1   border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-black/90 dark:text-black/10 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1  border-b-2 border-transparent text-sm font-medium leading-5 text-black/50 dark:text-black/40 hover:text-black/70 dark:hover:text-gray-300 hover:border-black/30 dark:hover:border-black/70 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

