<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Okipa\LaravelFormComponents\FormBinder;

trait HasOptions
{
    public function isSelected(string $name, string|int $value): bool
    {
        $oldValue = $this->getOldValue();
        if (isset($oldValue)) {
            return in_array($value, (array) $oldValue, false);
        }
        if ($this->selected) {
            return in_array($value, (array) $this->selected, false);
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return in_array($value, (array) data_get($dataBatch, $name), false);
    }

    protected function getOldValue(): mixed
    {
        if (! old()) {
            return null;
        }
        $oldValue = data_get(old(), $this->name);
        if ($oldValue) {
            return $oldValue;
        }

        return array_key_exists($this->name, old(default: [])) ? '' : null;
    }
}
