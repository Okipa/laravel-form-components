<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Closure;

trait HasAddon
{
    protected function getPrepend(): string|null
    {
        if ($this->prepend instanceof Closure) {
            return ($this->prepend)(app()->getLocale());
        }

        return $this->prepend;
    }

    protected function getAppend(): string|null
    {
        if ($this->append instanceof Closure) {
            return ($this->append)(app()->getLocale());
        }

        return $this->append;
    }
}
