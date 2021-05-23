<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HasValidation
{
    protected function shouldDisplayFailedValidation(): bool
    {
        return is_null($this->displayFailure)
            ? config('form-components.display_failed_validation', true)
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
        if ($this->getErrorMessageBag($errors)->has($this->getNameWithArrayNotationConvertedInto())) {
            return $this->shouldDisplayFailedValidation() ? 'is-invalid' : null;
        }

        // Highlight field with `is-valid` class when other errors are detected but not for this field.
        return $this->shouldDisplaySucceededValidation() ? 'is-valid' : null;
    }
}
