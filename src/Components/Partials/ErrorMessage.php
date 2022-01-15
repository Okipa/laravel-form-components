<?php

namespace Okipa\LaravelFormComponents\Components\Partials;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class ErrorMessage extends AbstractComponent
{
    public function __construct(public string|null $message)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.error-message';
    }
}
