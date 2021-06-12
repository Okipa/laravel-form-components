@php
    $id = $getId() ?: $getDefaultId('toggle-switch');
    $label = $getLabel();
    $checked = $getChecked();
    $errorMessage = $getErrorMessage($errors);
@endphp
<div class="component-container form-check form-switch mb-3">
    <input type="checkbox" {{ $attributes->merge([
            'id' => $id,
            'class' => 'component form-check-input ' . $getValidationClass($errors),
            'name' => $name,
            'aria-describedby' => $caption ? $id . '-caption' : null,
            'checked' => $checked
        ]) }}>
    <x-form::partials.label :id="$id" class="form-check-label" :label="$label"/>
    <x-form::partials.caption :inputId="$id" :caption="$caption"/>
    <x-form::partials.error-message :message="$errorMessage"/>
</div>
