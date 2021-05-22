@if($caption)
    <div {{ $attributes->merge(['class' => 'form-text']) }}>{!! $caption !!}</div>
@endif
