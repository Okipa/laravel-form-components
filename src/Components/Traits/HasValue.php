<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Closure;

trait HasValue
{
    protected function getValue(): mixed
    {
        $oldValue = $this->getOldValue();
        if (isset($oldValue)) {
            return $oldValue;
        }
        if ($this->value instanceof Closure) {
            return ($this->value)(app()->getLocale());
        }
        return $this->value ?? $this->model?->getAttribute($this->name);
    }

    protected function getOldValue(): mixed
    {
        if (! old()) {
            return null;
        }
        $name = $this->getNameWithArrayNotationConvertedInto();
        $oldValue = data_get(old(), $name);
        if ($oldValue) {
            return $oldValue;
        }

        return array_key_exists($name, old()) ? '' : null;
    }
}
