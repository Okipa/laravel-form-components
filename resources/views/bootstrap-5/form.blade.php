@php
    $methodSpoofing = in_array($method, ['PUT', 'PATCH', 'DELETE']);
@endphp
<form method="{{ $methodSpoofing ? 'POST' : $method }}" novalidate>
    @unless(in_array($method, ['HEAD', 'GET', 'OPTIONS']))
        @csrf
    @endunless
    @if($methodSpoofing)
        @method($method)
    @endif
    {!! $slot ?? null !!}
</form>
