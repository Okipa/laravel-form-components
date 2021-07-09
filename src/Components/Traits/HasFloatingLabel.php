<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

trait HasFloatingLabel
{
    protected function getFloatingLabel(): bool
    {
        return is_null($this->floatingLabel)
            ? config('form-components.floating_label', false)
            : $this->floatingLabel;
    }
}
