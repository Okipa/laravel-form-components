<button {!! $attributes->merge(['class' => 'btn btn-primary', 'type' => 'submit']) !!}>
    {!! $slot ?? __('Submit') !!}
</button>
