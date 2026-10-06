<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center justify-center rounded-xl border border-transparent bg-brand-brown px-5 py-3 text-sm font-semibold text-white transition duration-200 ease-in-out hover:bg-brand-green focus:outline-none focus:ring-2 focus:ring-brand-brown focus:ring-offset-2 active:bg-brand-brown'
    ]) }}
>
    {{ $slot }}
</button>