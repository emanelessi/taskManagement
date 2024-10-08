@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black/70 dark:text-black/30']) }}>
    {{ $value ?? $slot }}
</label>
