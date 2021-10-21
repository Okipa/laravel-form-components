@foreach($locales as $locale)
    @props([
        'id' => $getId($locale) ?: $getDefaultId($type, $locale),
        'label' => $getLabel($locale),
        'displayFloatingLabel' => $shouldDisplayFloatingLabel(),
        'placeholder' => $getPlaceholder($getLabel($locale), $locale),
        'value' => $getValue($locale),
        'prepend' => $getPrepend($locale),
        'append' => $getAppend($locale),
        'errorMessage' => $getErrorMessage($errors, $locale),
        'validationClass' => $getValidationClass($errors, $locale),
        'formLivewireModifier' => app(Okipa\LaravelFormComponents\FormBinder::class)->getBoundLivewireModifer(),
        'componentLivewireModelModifier' => $attributes->has('wire') && ! $attributes->get('wire') ? '' : $attributes->get('wire'),
        'hasNormalLivewireModelBinding' => $attributes->whereStartsWith('wire:model')->first(),
        'isWired' => $formLivewireModifier || $hasNormalLivewireModelBinding || $componentLivewireModelModifier,
    ])
    <div @class(['d-none' => $type === 'hidden', 'form-floating' => $displayFloatingLabel, 'mb-3' => $marginBottom])>
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
            <input {{ $attributes->except('wire')->merge([
                // Set $getLivewireModifier method in a trait
                'wire:model.' . ($componentLivewireModelModifier ?? $formLivewireModifier) => $hasNormalLivewireModelBinding
                    ? null
                    : ($locale ? $name . '.' . $locale : $name),
                'id' => $id,
                'class' => 'form-control' . ($validationClass ? ' ' . $validationClass : null),
                'type' => $type,
                'name' => $isWired ? null : ($locale ? $name . '[' . $locale . ']' : $name),
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'aria-describedby' => $caption ? $id . '-caption' : null,
                'value' => $isWired ? null : ($value ?? ''),
            ]) }}/>
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
