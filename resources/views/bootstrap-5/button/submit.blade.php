<button {!! $attributes->merge([
    'class' => 'btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'type' => 'submit',
    'title' => $attributes->has('title')
        ? $attributes->get('title')
        : ($slot->isNotEmpty() ? strip_tags($slot) : null),
]) !!}>
    {{ $slot->isNotEmpty() ? $slot : __('Submit') }}
</button>
