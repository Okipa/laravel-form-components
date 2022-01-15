<?php

namespace Okipa\LaravelFormComponents\Components\Partials;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Caption extends AbstractComponent
{
    public function __construct(public string $inputId, public string|null $caption)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.caption';
    }
}
