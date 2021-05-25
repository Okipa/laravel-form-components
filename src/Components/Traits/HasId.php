<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\Str;

trait HasId
{
    public function getId(string|null $locale): string|null
    {
        return $this->id ? $this->id . ($locale ? '-' . $locale : '') : $this->getDefaultId($locale);
    }

    protected function getDefaultId(string|null $locale): string
    {
        return $this->type . '-'
            . Str::slug(Str::snake($this->getNameWithArrayNotationConvertedInto('-'), '-'))
            . ($locale ? '-' . $locale : '');
    }
}
