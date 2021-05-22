<div class="{{ $type === 'hidden' ? 'd-none' : 'mb-3'}}{{  $floatingLabel ? ' form-floating' : null }}{{ $prepend || $append ? ' input-group' : null }}">
    @unless($floatingLabel)
        <x-label :id="$id" :label="$label"/>
        @if($prepend)
            <x-addon :addon="$prepend"/>
        @endisset
    @endunless
    <input {{ $attributes->merge(array_merge([
        'id' => $id,
        'class' => 'form-control ' . $validationClass($errors ?? null, $locale ?? null)
    ], $caption ? ['aria-describedby' => $id . '-caption'] : [])) }}
           type="{{ $type }}"
           name="{{ $name }}"
           value="{{ $value }}"/>
    @isset($append)
        <div class="input-group-text">
            {!! $append !!}
        </div>
    @endisset
    @if($floatingLabel)
        <x-label :id="$id" :label="$label"/>
    @else
        @if($append)
            <x-addon :addon="$append"/>
        @endisset
    @endif
    <x-caption :caption="$caption"/>
    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>
