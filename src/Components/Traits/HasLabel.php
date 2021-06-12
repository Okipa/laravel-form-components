<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasLabel
{
    public function getLabel(string|null $locale = null): string|null
    {
        if ($this->hideLabel) {
            return null;
        }
        if ($this->label) {
            return $this->label . ($locale ? ' (' . strtoupper($locale) . ')' : '');
        }

        return $this->getNameTranslationFromValidation($locale);
    }

    protected function getFloatingLabel(): bool
    {
        return is_null($this->floatingLabel)
            ? config('form-components.floating_label', false)
            : $this->floatingLabel;
    }
}
