@php
    $groupMode = (bool) array_filter($group);
    if($groupMode && $caption) {
        $captionId = $getId() ?: $getDefaultId('checkbox');
    }
    $errorMessage = $getErrorMessage($errors);
    $validationClass = $getValidationClass($errors);
    $isWired = $componentIsWired();
@endphp
@if($groupMode)
    <div @class(['mb-3' => $marginBottom, $validationClass => $validationClass])>
        <div>
            <x-form::partials.label class="form-label" :label="$getLabel()"/>
        </div>
@endif
@foreach($group as $groupValue => $groupLabel)
    @php
        $id = $getId(suffix: $groupMode ? $groupValue : null)
            ?: $getDefaultId(prefix: 'checkbox', suffix: $groupMode ? $groupValue : null);
        $label = $groupMode ? $groupLabel : $getLabel();
        $checked = $groupMode ? $getGroupModeCheckedStatus($groupValue) : $getSingleModeCheckedStatus();
    @endphp
    <div @class(['form-check', 'form-check-inline' => $inline, 'mb-3' => $groupMode ? null : $marginBottom])>
        <input {{ $attributes->merge([
            'wire:model' . $getComponentLivewireModifier() => $isWired && ! $hasStandardLivewireModelBinding() ? $name : null,
            'id' => $id,
            'class' => 'form-check-input' . ($validationClass && ! $groupMode ? ' ' . $validationClass : null),
            'name' => $isWired ? null : $name . ($groupMode ? '['. $groupValue .']' : null),
            'aria-describedby' => $caption ? ($groupMode && $caption ? $captionId : $id) . '-caption' : null,
            'checked' => $isWired ? null : $checked
        ]) }} type="checkbox">
        <x-form::partials.label :id="$id" class="form-check-label" :label="$label"/>
        @if(! $groupMode)
            <x-form::partials.caption :inputId="$id" :caption="$caption"/>
            <x-form::partials.error-message :message="$errorMessage"/>
        @endif
    </div>
@endforeach
@if($groupMode)
    <x-form::partials.caption :inputId="$groupMode && $caption ? $captionId : $id" :caption="$caption"/>
    <x-form::partials.error-message :message="$errorMessage"/>
@endif
@if($groupMode)
    </div>
@endif
