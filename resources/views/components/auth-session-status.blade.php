@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-text  ']) }}>
        {{ $status }}
    </div>
@endif
