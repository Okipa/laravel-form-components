@php
    $slot = $slot ?? null;
@endphp
<button {!! $attributes->merge([
    'class' => 'component btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'type' => 'submit',
    'title' => $attributes->has('title')
        ? $attributes->get('title')
        : ($slot ? strip_tags($slot) : null),
]) !!}>
    {{ $slot ?? __('Submit') }}
</button>
