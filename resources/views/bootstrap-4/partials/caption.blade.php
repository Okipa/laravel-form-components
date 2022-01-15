@if($caption)
    <div {{ $attributes->merge([
        'id' => $inputId . '-caption',
        'class' => 'form-text',
    ]) }}>{!! $caption !!}</div>
@endif
