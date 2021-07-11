@php
    $slot = $slot ?? null;
@endphp
<a {!! $attributes->merge([
    'class' => 'component btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'title' => $attributes->has('title')
        ? $attributes->get('title')
        : ($slot ? strip_tags($slot) : null),
    'role' => 'button',
]) !!}>
    {{ $slot }}
</a>
