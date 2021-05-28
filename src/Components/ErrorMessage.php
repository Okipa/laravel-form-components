<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class ErrorMessage extends AbstractComponent
{
    public function __construct(public string|null $message)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'error-message';
    }
}
