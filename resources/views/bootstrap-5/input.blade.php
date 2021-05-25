@foreach($locales as $locale)
    @php
        $id = $getId($locale);
        $label = $getLabel($locale);
        $placeholder = $getPlaceholder($locale, $label);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage = $getErrorMessage($errors, $locale);
    @endphp
    <div class="{{ $type === 'hidden' ? 'd-none' : 'mb-3'}}{{  $floatingLabel ? ' form-floating' : null }}{{ $prepend || $append ? ' input-group' : null }}">
        @unless($floatingLabel)
            <x-label :id="$id" :label="$getLabel($locale)"/>
            @if($prepend)
                <x-addon :addon="$prepend"/>
            @endisset
        @endunless
        <input {{ $attributes->merge(array_merge([
            'id' => $id,
            'class' => 'form-control ' . $validationClass($errors, $locale),
            'placeholder' => $placeholder,
            'data-locale' => $locale,
        ], $caption ? ['aria-describedby' => $id . '-caption'] : [])) }} type="{{ $type }}" name="{{ $locale ? $name . '[' . $locale . ']' : $name }}" value="{{ $value }}"/>
        @if($floatingLabel)
            <x-label :id="$id" :label="$label"/>
        @else
            @if($append)
                <x-addon :addon="$append"/>
            @endisset
        @endif
        <x-caption :inputId="$id" :caption="$caption"/>
        <x-error-message :message="$errorMessage"/>
    </div>
@endforeach
