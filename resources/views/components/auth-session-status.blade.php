@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-text  ']) }}>
        {{__('You have been logged out due to inactivity.')}}
    </div>
@endif


