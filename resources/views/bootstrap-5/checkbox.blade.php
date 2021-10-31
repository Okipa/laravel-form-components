@php
    $groupMode = (bool) array_filter($group);
@endphp
@if($groupMode)
    <div>
@endif
@foreach($group as $groupValue => $groupLabel)
    @php
        $id = $getId(suffix: $groupMode ? $groupValue : null) ?: $getDefaultId(prefix: 'checkbox', suffix: $groupMode ? $groupValue : null);
        $label = $getLabel();
        $checked = $groupMode ? $getGroupModeCheckedStatus($groupValue) : $getSingleModeCheckedStatus();
        $errorMessage = $getErrorMessage($errors);
        $validationClass = $getValidationClass($errors);
        $isWired = $componentIsWired();
    @endphp
    <div @class(['form-check', 'form-check-inline' => $inline, 'mb-3' => $marginBottom])>
        <input {{ $attributes->merge([
            'wire:model' . $getComponentLivewireModifier() => $isWired && ! $hasStandardLivewireModelBinding() ? $name : null,
            'id' => $id,
            'class' => 'form-check-input' . ($validationClass ? ' ' . $validationClass : null),
            'name' => $isWired ? null : $name . ($groupMode ? '['. $groupValue .']' : null),
            'aria-describedby' => $caption ? $id . '-caption' : null,
            'checked' => $isWired ? null : $checked
        ]) }} type="checkbox">
        <x-form::partials.label :id="$id" class="form-check-label" :label="$label"/>
        @if(! $groupMode)
            <x-form::partials.caption :inputId="$id" :caption="$caption"/>
        @endif
        <x-form::partials.error-message :message="$errorMessage"/>
    </div>
@endforeach
@if($groupMode)
    <x-form::partials.caption :inputId="$id" :caption="$caption"/>
@endif
@if($groupMode)
    </div>
@endif
