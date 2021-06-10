<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Submit extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'submit';
    }
}
