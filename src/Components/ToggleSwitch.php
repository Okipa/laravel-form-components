<?php

namespace Okipa\LaravelFormComponents\Components;

class ToggleSwitch extends Checkbox
{
    protected function setViewPath(): string
    {
        $this->toggleSwitch = true;

        return 'checkbox';
    }
}
