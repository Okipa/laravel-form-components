<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Okipa\LaravelFormComponents\FormBinder;

trait CanBeWired
{
    public function componentIsWired(): bool
    {
        return $this->getFormLivewireModifier()
            || $this->hasStandardLivewireModelBinding()
            || $this->getComponentLivewireModifier();
    }

    protected function getFormLivewireModifier(): string
    {
        $formLivewireModifier = app(FormBinder::class)->getBoundLivewireModifer();

        return $formLivewireModifier ? '.' . $formLivewireModifier : '';
    }

    public function hasStandardLivewireModelBinding(): bool
    {
        return (bool) $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function getComponentLivewireModifier()
    {
        $hasComponentLivewireModelModifier = $this->attributes->has('wire');
        $componentLivewireModelModifierAttribute = $this->attributes->get('wire');
        $componentLivewireModelModifier = $componentLivewireModelModifierAttribute
            ? '.' . $componentLivewireModelModifierAttribute
            : '';

        return $hasComponentLivewireModelModifier ? $componentLivewireModelModifier : $this->getFormLivewireModifier();
    }
}
