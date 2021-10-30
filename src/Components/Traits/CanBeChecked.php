<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Okipa\LaravelFormComponents\FormBinder;

trait CanBeChecked
{
    public function getSingleModeCheckedStatus(): bool
    {
        $oldChecked = old($this->name);
        if (isset($oldChecked)) {
            return $oldChecked;
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return $this->checked ?? (bool) data_get($dataBatch, $this->name);
    }

    public function getGroupModeCheckedStatus(int|string $value)
    {
//        if (old($this->name)) {
//            return (string) old($this->name) === (string) $value;
//        }
        if ($this->checked) {
            return in_array((string) $value, array_map('strval', $this->checked), true);
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return (string) data_get($dataBatch, $this->name) === (string) $value;
    }
}
