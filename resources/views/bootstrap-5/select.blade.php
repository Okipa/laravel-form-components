@php
    $id = $getId() ?: $getDefaultId('select');
    $label = $getLabel();
    $displayFloatingLabel = $shouldDisplayFloatingLabel();
    $placeholder = $getPlaceholder($label);
    $prepend = $getPrepend();
    $append = $getAppend();
    $errorMessage = $getErrorMessage($errors);
    $multipleMode = (bool) $attributes->filter(fn($value, $key) => $key === 'multiple')->first();
    $validationClass = $getValidationClass($errors);
    $isWired = $componentIsWired();
@endphp
<div @class(['form-floating' => $displayFloatingLabel, 'mb-3' => $marginBottom])>
    @if(($prepend || $append) && ! $displayFloatingLabel)
        <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
        <div class="input-group">
    @endif
        @if(! $prepend && ! $append && ! $displayFloatingLabel)
            <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
        @endif
        @if($prepend && ! $displayFloatingLabel)
            <x:form::partials.addon :addon="$prepend"/>
        @endif
        <select {{ $attributes->merge([
            'wire:model' . $getComponentLivewireModifier() => $isWired && ! $hasComponentNativeLivewireModelBinding()? $name : null,
            'id' => $id,
            'class' => 'form-select' . ($validationClass ? ' ' . $validationClass : null),
            'name' => $name . ($multipleMode ? '[]' : null),
            'placeholder' => $placeholder,
            'aria-describedby' => $caption ? $id . '-caption' : null,
        ]) }}>
            @if($placeholder)
                <option value="" selected{!! $allowPlaceholderToBeSelected ? null : ' disabled hidden' !!}>{{ $placeholder }}</option>
            @endif
            @foreach($options as $value => $label)
                <option value="{{ $value }}"{!! $isSelected($name, $value) && ! $isWired ? ' selected="selected"' : null !!}>{{ $label }}</option>
            @endforeach
        </select>
        @if(! $prepend && ! $append && $displayFloatingLabel)
            <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
        @endif
        @if($append && ! $displayFloatingLabel)
            <x:form::partials.addon :addon="$append"/>
        @endif
        <x:form::partials.caption :inputId="$id" :caption="$caption"/>
        <x:form::partials.error-message :message="$errorMessage"/>
    @if(($prepend || $append) && ! $displayFloatingLabel)
        </div>
    @endif
</div>
