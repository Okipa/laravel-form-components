<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasName
{
    protected function getNameTranslationFromValidation(string|null $locale): string
    {
        return __('validation.attributes.' . $this->getNameWithoutArrayNotation())
            . ($locale ? ' (' . strtoupper($locale) . ')' : '');
    }

    protected function getNameWithoutArrayNotation(): string
    {
        return strstr($this->name, '[', true) ?: $this->name;
    }

    protected function getNameWithArrayNotationConvertedInto(string $notation = '.'): string
    {
        return str_replace(['[', ']'], [$notation, ''], $this->name);
    }
}
