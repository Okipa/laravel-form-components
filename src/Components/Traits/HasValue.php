<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Closure;
use Okipa\LaravelFormComponents\FormBinder;

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
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();
        if ($locale) {
            return $this->value ?? data_get($dataBatch, $this->name . '.' . $locale);
        }

        return $this->value ?? data_get($dataBatch, $this->name);
    }

    protected function getOldValue(string|null $locale): mixed
    {
        if (! old()) {
            return null;
        }
        $oldValue = data_get(old(), $this->name . ($locale ? '.' . $locale : ''));
        if ($oldValue) {
            return $oldValue;
        }

        return array_key_exists($this->name, old()) ? '' : null;
    }
}
