<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HasValidation
{
    public function validationClass(ViewErrorBag $errors): string|null
    {
        if ($this->getErrorMessageBag($errors)->isEmpty()) {
            return null;
        }
        if ($this->getErrorMessageBag($errors)->has($this->getNameWithArrayNotationConvertedInto())) {
            return $this->displayValidationFailure ? 'is-invalid' : null;
        }

        return $this->displayValidationSuccess ? 'is-valid' : null;
    }

    protected function getErrorMessageBag(ViewErrorBag $errors): MessageBag
    {
        return $errors->{$this->errorBag};
    }

    public function errorMessage(ViewErrorBag $errors): string|null
    {
        if (! $this->displayValidationFailure) {
            return null;
        }

        return $this->getErrorMessageBag($errors)->first($this->getNameWithArrayNotationConvertedInto());
    }

    protected function shouldDisplayValidationFailure(): bool
    {
        return is_null($this->displayValidationFailure)
            ? config('form-components.display_validation_failure', true)
            : $this->displayValidationFailure;
    }

    protected function shouldDisplayValidationSuccess(): bool
    {
        return is_null($this->displayValidationSuccess)
            ? config('form-components.display_validation_success', true)
            : $this->displayValidationSuccess;
    }
}
