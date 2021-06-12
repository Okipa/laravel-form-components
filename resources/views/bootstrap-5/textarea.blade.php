@foreach($locales as $locale)
    @php
        $id = $getId($locale) ?: $getDefaultId('textarea', $locale);
        $label = $getLabel($locale);
        $placeholder = $getPlaceholder($locale, $label);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage = $getErrorMessage($errors, $locale);
    @endphp
    <div class="component-container mb-3{{  $floatingLabel ? ' form-floating' : null }}{{ $prepend || $append ? ' input-group' : null }}">
        @unless($floatingLabel)
            <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            @if($prepend)
                <x-form::partials.addon :addon="$prepend"/>
            @endisset
        @endunless
        <textarea {{ $attributes->merge([
            'id' => $id,
            'class' => 'component form-control ' . $getValidationClass($errors, $locale),
            'name' => $locale ? $name . '[' . $locale . ']' : $name,
            'placeholder' => $placeholder,
            'data-locale' => $locale,
            'aria-describedby' => $caption ? $id . '-caption' : null,
        ])}}>{{ $value }}</textarea>
        @if($floatingLabel)
            <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
        @else
            @if($append)
                <x-form::partials.addon :addon="$append"/>
            @endisset
        @endif
        <x-form::partials.caption :inputId="$id" :caption="$caption"/>
        <x-form::partials.error-message :message="$errorMessage"/>
    </div>
@endforeach
