@if($label)
    <label {{ $attributes->merge(['for' => $id]) }}>{{ $label }}</label>
@endif
