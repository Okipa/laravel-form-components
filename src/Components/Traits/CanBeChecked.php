<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Okipa\LaravelFormComponents\FormBinder;

trait CanBeChecked
{
    public function getChecked(): bool
    {
        $oldChecked = old($this->name);
        if (isset($oldChecked)) {
            return $oldChecked;
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return $this->checked ?? (bool) data_get($dataBatch, $this->name);
    }
}
