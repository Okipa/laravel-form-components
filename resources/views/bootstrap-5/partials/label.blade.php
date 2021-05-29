@if($label)
    <label {{ $attributes->merge(['for' => $id, 'class' => 'form-label']) }}>{{ $label }}</label>
@endif
