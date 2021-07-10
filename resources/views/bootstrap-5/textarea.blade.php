@foreach($locales as $locale)
    @php
        $id = $getId($locale) ?: $getDefaultId('textarea', $locale);
        $label = $getLabel($locale);
        $displayFloatingLabel = $shouldDisplayFloatingLabel();
        $placeholder = $getPlaceholder($label, $locale);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage = $getErrorMessage($errors, $locale);
        $validationClass = $getValidationClass($errors);
    @endphp
    <div class="component-container mb-3{{ $displayFloatingLabel ? ' form-floating' : null }}">
        @if(($prepend || $append) && ! $displayFloatingLabel)
            <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            <div class="input-group">
        @endif
            @if(! $prepend && ! $append && ! $displayFloatingLabel)
                <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            @endif
            @if($prepend && ! $displayFloatingLabel)
                <x-form::partials.addon :addon="$prepend"/>
            @endif
            <textarea {{ $attributes->merge([
                'id' => $id,
                'class' => 'component form-control' . ($validationClass ? ' ' . $validationClass : null),
                'name' => $locale ? $name . '[' . $locale . ']' : $name,
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'aria-describedby' => $caption ? $id . '-caption' : null,
            ])}}>{{ $value }}</textarea>
            @if(! $prepend && ! $append && $displayFloatingLabel)
                <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            @endif
            @if($append && ! $displayFloatingLabel)
                <x-form::partials.addon :addon="$append"/>
            @endif
            <x-form::partials.caption :inputId="$id" :caption="$caption"/>
            <x-form::partials.error-message :message="$errorMessage"/>
        @if(($prepend || $append) && ! $displayFloatingLabel)
            </div>
        @endif
    </div>
@endforeach
