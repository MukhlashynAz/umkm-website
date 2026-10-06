@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full border-l-4 border-brand-green bg-brand-yellow/20 px-4 py-2 text-start text-base font-medium text-brand-brown transition duration-150 ease-in-out focus:border-brand-brown focus:bg-brand-yellow/30 focus:outline-none'
        : 'block w-full border-l-4 border-transparent px-4 py-2 text-start text-base font-medium text-gray-600 transition duration-150 ease-in-out hover:border-brand-yellow hover:bg-gray-50 hover:text-brand-brown focus:border-brand-yellow focus:bg-gray-50 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>