@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center border-b-2 border-brand-green px-1 pt-1 text-sm font-medium leading-5 text-brand-brown transition duration-150 ease-in-out focus:outline-none focus:border-brand-brown'
        : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out hover:border-brand-yellow hover:text-brand-brown focus:outline-none focus:border-brand-yellow focus:text-brand-brown';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>