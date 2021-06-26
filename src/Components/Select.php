<?php

namespace Okipa\LaravelFormComponents\Components;

use Closure;
use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\Components\Traits\HasAddon;
use Okipa\LaravelFormComponents\Components\Traits\HasId;
use Okipa\LaravelFormComponents\Components\Traits\HasLabel;
use Okipa\LaravelFormComponents\Components\Traits\HasName;
use Okipa\LaravelFormComponents\Components\Traits\HasOptions;
use Okipa\LaravelFormComponents\Components\Traits\HasPlaceholder;
use Okipa\LaravelFormComponents\Components\Traits\HasValidation;

class Select extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasPlaceholder;
    use HasAddon;
    use HasOptions;
    use HasValidation;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        public array $options,
        public string|null $id = null,
        public array|object|null $bind = null,
        public string|null $label = null,
        public bool|null $floatingLabel = null,
        public bool $hideLabel = false,
        public string|null $placeholder = null,
        public bool $hidePlaceholder = false,
        public string|Closure|null $prepend = null,
        public string|Closure|null $append = null,
        public int|string|array|null $selected = null,
        public string|null $caption = null,
        public bool|null $displayValidationSuccess = null,
        public bool|null $displayValidationFailure = null,
        public string $errorBag = 'default',
    ) {
        $this->floatingLabel = $this->getFloatingLabel();
        $this->displayValidationSuccess = $this->shouldDisplayValidationSuccess();
        $this->displayValidationFailure = $this->shouldDisplayValidationFailure();
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'select';
    }
}
