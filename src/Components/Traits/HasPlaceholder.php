<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasPlaceholder
{
    public function getPlaceholder(string $label, string $locale = null): string|null
    {
        if ($this->hidePlaceholder) {
            return null;
        }
        if ($this->placeholder) {
            return $this->placeholder . ($locale ? ' (' . strtoupper($locale) . ')' : '');
        }

        return $label ?: $this->getNameTranslationFromValidation($locale);
    }
}
