@php
    $id = $getId() ?: $getDefaultId('select');
    $label = $getLabel();
    $placeholder = $getPlaceholder($label);
    $prepend = $getPrepend();
    $append = $getAppend();
    $errorMessage = $getErrorMessage($errors);
    $multipleMode =  (bool) $attributes->filter(fn($value) => $value === 'multiple')->first();
@endphp
<div class="component-container mb-3{{ $floatingLabel ? ' form-floating' : null }}">
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
        <select {{ $attributes->merge([
            'id' => $id,
            'name' => $name . ($multipleMode ? '[]' : null),
            'class' => 'component form-select ' . $getValidationClass($errors),
            'placeholder' => $placeholder,
            'aria-describedby' => $caption ? $id . '-caption' : null,
        ]) }}>
            @if($placeholder)
                <option value="" selected disabled hidden>{{ $placeholder }}</option>
            @endif
            @foreach($options as $value => $label)
                <option value="{{ $value }}"{!! $isSelected($name, $value) ? ' selected="selected"' : null !!}>{{ $label }}</option>
            @endforeach
        </select>
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
