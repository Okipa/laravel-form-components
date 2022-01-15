<?php

namespace Okipa\LaravelFormComponents\Components\Button;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Submit extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'button.submit';
    }
}
