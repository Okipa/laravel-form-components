@php
    $id = $getId() ?: $getDefaultId('checkbox');
    $label = $getLabel();
    $checked = $getChecked();
    $errorMessage = $getErrorMessage($errors);
    $validationClass = $getValidationClass($errors);
@endphp
<div class="form-check">
    <input type="checkbox" {{ $attributes->merge([
        'id' => $id,
        'class' => 'form-check-input' . ($validationClass ? ' ' . $validationClass : null),
        'name' => $name,
        'aria-describedby' => $caption ? $id . '-caption' : null,
        'checked' => $checked
    ]) }}>
    <x-form::partials.label :id="$id" class="form-check-label" :label="$label"/>
    <x-form::partials.caption :inputId="$id" :caption="$caption"/>
    <x-form::partials.error-message :message="$errorMessage"/>
</div>
