@foreach($group as $value => $label)
    @php
        $radioId = $getId(suffix: $value) ?: $getDefaultId(prefix: 'radio', suffix: $value);
        $captionId = $getId() ?: $getDefaultId('radio');
        $checked = $getChecked($value);
        $errorMessage = $getErrorMessage($errors);
        $validationClass = $getValidationClass($errors);
    @endphp
    <div class="form-check">
        <input {{ $attributes->merge([
            'id' => $radioId,
            'class' => 'form-check-input' . ($validationClass ? ' ' . $validationClass : null),
            'name' => $name,
            'value' => $value,
            'aria-describedby' => $caption ? $captionId . '-caption' : null,
            'checked' => $checked
        ]) }} type="radio">
        <x-form::partials.label :id="$radioId" class="form-check-label" :label="$label"/>
    </div>
@endforeach
<x-form::partials.caption :inputId="$captionId" :caption="$caption"/>
<x-form::partials.error-message :message="$errorMessage"/>
