<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center justify-center rounded-xl border border-transparent bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 ease-in-out hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown focus:outline-none focus:ring-2 focus:ring-brand-green/30 focus:ring-offset-2'
    ]) }}
>
    {{ $slot }}
</button>