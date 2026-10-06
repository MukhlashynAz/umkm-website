@props(['status'])

@if ($status)
    <div
        {{ $attributes->merge([
            'class' => 'rounded-xl border border-brand-green/20 bg-brand-green/5 px-4 py-3 text-sm font-medium text-brand-green'
        ]) }}
    >
        {{ $status }}
    </div>
@endif