<a
    {{ $attributes->merge([
        'class' => 'block w-full rounded-lg px-4 py-2.5 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-brand-yellow/20 hover:text-brand-brown focus:bg-brand-yellow/20 focus:text-brand-brown focus:outline-none'
    ]) }}
>
    {{ $slot }}
</a>