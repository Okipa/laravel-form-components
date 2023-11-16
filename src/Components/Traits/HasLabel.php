<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasLabel
{
    public function getLabel(string|false $locale = null): string|null
    {
        if ($this->label === false) {
            return null;
        }
        if ($this->label) {
            return $this->label . ($locale ? ' (' . mb_strtoupper($locale) . ')' : '');
        }

        return $this->getNameTranslationFromValidation($locale);
    }
}
