<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasName
{
    protected function getNameTranslationFromValidation(): string
    {
        return __('validation.attributes.' . $this->getNameWithoutArrayNotation());
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
