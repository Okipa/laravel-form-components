<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HasValidation
{
    public function getValidationClass(ViewErrorBag $errors): string|null
    {
        if ($this->getErrorBag($errors)->isEmpty()) {
            return null;
        }
        if ($this->getErrorBag($errors)->has($this->getNameWithArrayNotationConvertedInto())) {
            return $this->displayValidationFailure ? 'is-invalid' : null;
        }

        return $this->displayValidationSuccess ? 'is-valid' : null;
    }

    protected function getErrorBag(ViewErrorBag $errors): MessageBag
    {
        return $errors->{$this->errorBag};
    }

    public function getErrorMessage(ViewErrorBag $errors, string|null $locale = null): string|null
    {
        if (! $this->displayValidationFailure) {
            return null;
        }
        $errorBag = $this->getErrorBag($errors);
        if ($locale) {
            $errorKey = $this->name . '.' . $locale;
            $rawMessage = $errorBag->first($errorKey);

            return $rawMessage ? str_replace(
                str_replace('_', ' ', $this->name) . '.' . $locale,
                __('validation.attributes.' . $this->name) . ' (' . strtoupper($locale) . ')',
                $rawMessage
            ) : null;
        }

        return $errorBag->first($this->getNameWithArrayNotationConvertedInto());
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
