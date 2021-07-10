<?php

namespace Okipa\LaravelFormComponents\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\Components\Traits\HasAddon;
use Okipa\LaravelFormComponents\Components\Traits\HasFloatingLabel;
use Okipa\LaravelFormComponents\Components\Traits\HasId;
use Okipa\LaravelFormComponents\Components\Traits\HasLabel;
use Okipa\LaravelFormComponents\Components\Traits\HasName;
use Okipa\LaravelFormComponents\Components\Traits\HasPlaceholder;
use Okipa\LaravelFormComponents\Components\Traits\HasValidation;
use Okipa\LaravelFormComponents\Components\Traits\HasValue;

class Textarea extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasFloatingLabel;
    use HasValue;
    use HasPlaceholder;
    use HasAddon;
    use HasValidation;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        protected string|null $id = null,
        protected object|array|null $bind = null,
        protected string|null $label = null,
        protected bool $hideLabel = false,
        protected bool|null $floatingLabel = null,
        protected string|null $placeholder = null,
        protected bool $hidePlaceholder = false,
        protected string|Closure|null $prepend = null,
        protected string|Closure|null $append = null,
        protected string|int|array|Closure|null $value = null,
        public string|null $caption = null,
        protected bool|null $displayValidationSuccess = null,
        protected bool|null $displayValidationFailure = null,
        protected string $errorBag = 'default',
        public array $locales = [null]
    ) {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'textarea';
    }
}
