<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Closure;

trait HasValue
{
    public function getValue(string|null $locale): mixed
    {
        $oldValue = $this->getOldValue($locale);
        if (isset($oldValue)) {
            return $oldValue;
        }
        if ($this->value instanceof Closure) {
            return ($this->value)($locale ?: app()->getLocale());
        }
        if ($locale) {
            return $this->value ?? data_get($this->model, $this->name . '.' . $locale);
        }

        return $this->value ?? $this->model?->getAttribute($this->name);
    }

    protected function getOldValue(string|null $locale): mixed
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
