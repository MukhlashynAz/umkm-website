<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition duration-200 ease-in-out hover:border-brand-green hover:bg-brand-yellow/10 hover:text-brand-brown focus:outline-none focus:ring-2 focus:ring-brand-green/30 focus:ring-offset-2 disabled:opacity-50'
    ]) }}
>
    {{ $slot }}
</button>