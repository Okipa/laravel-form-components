<?php

namespace Okipa\LaravelFormComponents\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

class Input extends AbstractComponent
{
    public bool $floatingLabel;

    public function __construct(
        public string $name,
        public string $type = 'text',
        public Model|null $model = null,
        public int|string|null $value = null,
        public string|null $label = null,
        public bool $hideLabel = false,
        public string|Closure|null $prepend = null,
        public string|Closure|null $append = null,
        public string|null $placeholder = null,
        public bool $hidePlaceholder = false,
        public string|null $caption = null,
        protected bool|null $displaySuccess = null,
        protected bool|null $displayFailure = null,
        public string $errorBag = 'default',
    ) {
        $this->id = $this->getAttribute() ?: $this->getDefaultId();
        $this->label = $this->label ?: $this->getValidationTranslation();
        $this->placeholder = $this->placeholder ?: $this->getValidationTranslation();
        $this->floatingLabel = config('form-components.floating_label', false);
    }

    protected function shouldDisplayFailedValidation(): bool
    {
        return is_null($this->displayFailure)
            ? config('form-components.display_failed_validation', true)
            : $this->displayFailure;
    }

    protected function shouldDisplaySucceededValidation(): bool
    {
        return is_null($this->displayFailure)
            ? config('form-components.display_succeeded_validation', true)
            : $this->displayFailure;
    }

    protected function getErrorMessageBag(ViewErrorBag $errors): MessageBag
    {
        return $errors->{$this->errorBag};
    }

    public function validationClass(?ViewErrorBag $errors): string|null
    {
        // Do not highlight field if no errors are found.
        if (! $errors) {
            return null;
        }
        if ($this->getErrorMessageBag($errors)->isEmpty()) {
            return null;
        }
        // Highlight field with `is-invalid` class when it has an error.
        if ($this->getErrorMessageBag($errors)->has($this->convertArrayNameInNotation())) {
            return $this->shouldDisplayFailedValidation() ? 'is-invalid' : null;
        }

        // Highlight field with `is-valid` class when other errors are detected but not for this field.
        return $this->shouldDisplaySucceededValidation() ? 'is-valid' : null;
    }

    public function errorMessage(?ViewErrorBag $errors): string|null
    {
        if (! $errors) {
            return null;
        }
        if (! $this->shouldDisplayFailedValidation()) {
            return null;
        }

        return $this->getErrorMessageBag($errors)->first($this->convertArrayNameInNotation());
    }

    protected function getDefaultId(): string
    {
        return $this->type . '-' . Str::slug(Str::snake($this->convertArrayNameInNotation('-'), '-'));
    }

    protected function convertArrayNameInNotation(string $notation = '.'): string
    {
        return str_replace(['[', ']'], [$notation, ''], $this->name);
    }

    protected function getValidationTranslation(): string
    {
        return __('validation.attributes.' . $this->name);
    }

    protected function setViewPath(): string
    {
        return 'input';
    }
}
