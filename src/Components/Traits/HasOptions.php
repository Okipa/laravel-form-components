<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasOptions
{
    public function isSelected(string|int $value, bool $multipleMode): bool
    {
        return $multipleMode
            ? in_array($value, $this->selected, false)
            : (string) $value === (string) $this->selected;
    }
}
