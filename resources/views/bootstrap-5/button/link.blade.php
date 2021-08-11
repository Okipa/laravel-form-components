@php
    $slot = $slot ?? null;
@endphp
<a {!! $attributes->except('url')->merge([
    'class' => 'btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'title' => $attributes->has('title')
        ? $attributes->get('title')
        : ($slot ? strip_tags($slot) : null),
    'role' => 'button',
    'href' => $attributes->get('url'),
]) !!}>
    {{ $slot }}
</a>
