@foreach($locales as $locale)
    @php
        $id = $getId($locale) ?: $getDefaultId($type, $locale);
        $label = $getLabel($locale);
        $placeholder = $getPlaceholder($label, $locale);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage = $getErrorMessage($errors, $locale);
    @endphp
    <div class="component-container{{ $type === 'hidden' ? ' d-none' : ' mb-3'}}{{ $floatingLabel ? ' form-floating' : null }}">
        @if(($prepend || $append) && ! $floatingLabel)
            <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            <div class="input-group">
        @endif
            @if(! $prepend && ! $append && ! $floatingLabel)
                <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            @endif
            @if($prepend && ! $floatingLabel)
                <x-form::partials.addon :addon="$prepend"/>
            @endif
            <input {{ $attributes->merge([
                'id' => $id,
                'class' => 'component form-control ' . $getValidationClass($errors, $locale),
                'type' => $type,
                'name' => $locale ? $name . '[' . $locale . ']' : $name,
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'aria-describedby' => $caption ? $id . '-caption' : null,
            ]) }} value="{{ $value }}"/>
            @if(! $prepend && ! $append && $floatingLabel)
                <x-form::partials.label :id="$id" class="form-label" :label="$label"/>
            @endif
            @if($append && ! $floatingLabel)
                <x-form::partials.addon :addon="$append"/>
            @endif
            <x-form::partials.caption :inputId="$id" :caption="$caption"/>
            <x-form::partials.error-message :message="$errorMessage"/>
        @if(($prepend || $append) && ! $floatingLabel)
            </div>
        @endif
    </div>
@endforeach
