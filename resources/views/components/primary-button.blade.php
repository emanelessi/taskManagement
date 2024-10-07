<button {{ $attributes->merge(['type' => 'submit', 'class' => ' items-center  font-semibold text-xs text-white  uppercase  w-auto bg-tertiary text-white p-3 rounded-md hover:tertiary/80 transition-colors']) }}>
    {{ $slot }}
</button>
