<a {!! $attributes->merge([
    'class' => 'btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'title' => $attributes->has('title')
        ? $attributes->get('title')
        : ($slot->isNotEmpty() ? strip_tags($slot) : null),
    'role' => 'button',
]) !!}>
    {{ $slot }}
</a>
