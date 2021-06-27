<button {!! $attributes->merge([
    'class' => 'btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'type' => 'submit',
]) !!}>
    {{ $slot ?? __('Submit') }}
</button>
