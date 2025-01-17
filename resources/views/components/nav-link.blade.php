@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1   border-b-2 border-indigo-400   text-sm font-medium leading-5 text-black/90  focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1  border-b-2 border-transparent text-sm font-medium leading-5 text-black/50   hover:text-black/70  hover:border-black/30   focus:outline-none focus:text-gray-700   focus:border-gray-300  transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

