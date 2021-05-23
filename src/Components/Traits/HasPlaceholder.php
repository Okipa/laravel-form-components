<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasPlaceholder
{
    protected function getPlaceholder(): string|null
    {
        if ($this->hidePlaceholder) {
            return null;
        }
        if ($this->placeholder) {
            return $this->placeholder;
        }
        if ($this->label) {
            return $this->label;
        }

        return $this->getNameTranslationFromValidation();
    }
}
