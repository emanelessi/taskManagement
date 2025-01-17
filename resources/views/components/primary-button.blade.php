<button {{ $attributes->merge(['type' => 'submit', 'class' => 'items-center font-semibold text-xs text-white uppercase w-auto bg-button  p-3 rounded-md hover:bg-button/80 transition-colors']) }}>
    {{ $slot }}
</button>
