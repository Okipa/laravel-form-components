<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\Components\Traits\CanBeChecked;
use Okipa\LaravelFormComponents\Components\Traits\CanBeWired;
use Okipa\LaravelFormComponents\Components\Traits\HasId;
use Okipa\LaravelFormComponents\Components\Traits\HasLabel;
use Okipa\LaravelFormComponents\Components\Traits\HasName;
use Okipa\LaravelFormComponents\Components\Traits\HasValidation;

class Checkbox extends AbstractComponent
{
    use CanBeChecked;
    use CanBeWired;
    use HasId;
    use HasLabel;
    use HasName;
    use HasValidation;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        public array $group = [null],
        protected string|null $id = null,
        protected array|object|null $bind = null,
        protected string|false|null $label = null,
        protected bool|array|null $checked = null,
        public string|null $caption = null,
        protected bool|null $displayValidationSuccess = null,
        protected bool|null $displayValidationFailure = null,
        protected string|null $errorBag = null,
        public bool $marginBottom = true,
        public bool $inline = false,
        public bool $toggleSwitch = false
    ) {
        $this->displayValidationSuccess = $this->shouldDisplayValidationSuccess();
        $this->displayValidationFailure = $this->shouldDisplayValidationFailure();
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'checkbox';
    }
}
