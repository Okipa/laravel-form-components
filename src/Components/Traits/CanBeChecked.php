<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Closure;
use Okipa\LaravelFormComponents\FormBinder;

trait CanBeChecked
{
    public function getChecked(): bool
    {
        $oldCheck = $this->getOldChecked();
        if (isset($oldCheck)) {
            return $oldCheck;
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return $this->checked ?? (bool) data_get($dataBatch, $this->name);
    }

    protected function getOldChecked(): bool|null
    {
        if (! old()) {
            return null;
        }
        $oldChecked = data_get(old(), $this->name);
        if ($oldChecked) {
            return (bool) $oldChecked;
        }

        return array_key_exists($this->name, old()) ? true : null;
    }
}
