<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasLabel
{
    protected function getLabel(): string|null
    {
        if ($this->hideLabel) {
            return null;
        }

        return $this->label ?: $this->getNameTranslationFromValidation();
    }

    protected function getFloatingLabel(): bool
    {
        return is_null($this->floatingLabel)
            ? config('form-components.floating_label', false)
            : $this->floatingLabel;
    }
}
