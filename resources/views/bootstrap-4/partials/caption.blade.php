@if($caption)
    <small {{ $attributes->merge([
        'id' => $inputId . '-caption',
        'class' => 'form-text text-muted',
    ]) }}>{!! $caption !!}</small>
@endif
