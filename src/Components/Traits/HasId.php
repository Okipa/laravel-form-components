<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\Str;

trait HasId
{
    protected function getId(): string|null
    {
        return $this->id ?: $this->getDefaultId();
    }

    protected function getDefaultId(): string
    {
        return $this->type . '-' . Str::slug(Str::snake($this->getNameWithArrayNotationConvertedInto('-'), '-'));
    }
}
