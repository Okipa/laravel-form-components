<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Okipa\LaravelFormComponents\FormBinder;

trait CanBeWired
{
    public function componentIsWired(): bool
    {
        return $this->hasFormLivewireBinding()
            || $this->hasComponentNativeLivewireModelBinding()
            || $this->hasComponentPackageLivewireBinding();
    }

    protected function hasFormLivewireBinding(): bool
    {
        return null !== app(FormBinder::class)->getBoundLivewireModifer();
    }

    public function hasComponentNativeLivewireModelBinding(): bool
    {
        return (bool) $this->attributes->whereStartsWith('wire:model')->first();
    }

    protected function hasComponentPackageLivewireBinding(): bool
    {
        return $this->attributes->has('wire');
    }

    public function getComponentLivewireModifier(): string
    {
        $hasComponentLivewireModelModifier = $this->attributes->has('wire');
        $componentLivewireModelModifierAttribute = $this->attributes->get('wire') === true
            ? ''
            : $this->attributes->get('wire');
        $componentLivewireModelModifier = $componentLivewireModelModifierAttribute
            ? '.' . $componentLivewireModelModifierAttribute
            : '';

        return $hasComponentLivewireModelModifier ? $componentLivewireModelModifier : $this->getFormLivewireModifier();
    }

    protected function getFormLivewireModifier(): string
    {
        $formLivewireModifier = app(FormBinder::class)->getBoundLivewireModifer();

        return $formLivewireModifier ? '.' . $formLivewireModifier : '';
    }
}
