<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\Components\Traits\CanBeChecked;
use Okipa\LaravelFormComponents\Components\Traits\HasId;
use Okipa\LaravelFormComponents\Components\Traits\HasLabel;
use Okipa\LaravelFormComponents\Components\Traits\HasName;
use Okipa\LaravelFormComponents\Components\Traits\HasValidation;

class ToggleSwitch extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasValidation;
    use CanBeChecked;

    public function __construct(
        public string $name,
        public string|null $id = null,
        public array|object|null $bind = null,
        public string|null $label = null,
        public bool $hideLabel = false,
        public bool|null $checked = null,
        public string|null $caption = null,
        public bool|null $displayValidationSuccess = null,
        public bool|null $displayValidationFailure = null,
        public string $errorBag = 'default',
    ) {
        $this->displayValidationSuccess = $this->shouldDisplayValidationSuccess();
        $this->displayValidationFailure = $this->shouldDisplayValidationFailure();
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'toggle-switch';
    }
}
