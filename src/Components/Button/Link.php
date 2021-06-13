<?php

namespace Okipa\LaravelFormComponents\Components\Button;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Link extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'button.link';
    }
}
