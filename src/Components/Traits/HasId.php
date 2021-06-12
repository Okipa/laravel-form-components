<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\Str;

trait HasId
{
    public function getId(string|null $locale = null): string|null
    {
        return $this->id ? $this->id . ($locale ? '-' . $locale : '') : null;
    }

    public function getDefaultId(string $prefix, string|null $locale = null): string
    {
        return Str::slug(Str::snake($prefix)) . '-'
            . Str::slug(Str::snake($this->getNameWithArrayNotationConvertedInto('-'), '-'))
            . ($locale ? '-' . $locale : '');
    }
}
