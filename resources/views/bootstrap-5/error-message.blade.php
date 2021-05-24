@if($message)
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>{{ $message }}</div>
@endif
