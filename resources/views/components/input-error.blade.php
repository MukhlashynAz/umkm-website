@props(['messages'])

@if ($messages)
    <ul
        {{ $attributes->merge([
            'class' => 'space-y-1 text-sm text-brand-brown'
        ]) }}
    >
        @foreach ((array) $messages as $message)
            <li class="flex items-start gap-2">
                <span class="mt-0.5 font-semibold">!</span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif