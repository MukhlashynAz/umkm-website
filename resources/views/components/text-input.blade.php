@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'block w-full rounded-xl border-gray-200 px-4 py-3 text-sm text-gray-900 shadow-sm transition duration-200 placeholder:text-gray-400 focus:border-brand-green focus:ring-brand-green/20 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:opacity-60'
    ]) }}
>