@if($addon)
    <span {{ $attributes->merge(['class' => 'input-group-text']) }}>{!! $addon !!}</span>
@endif
