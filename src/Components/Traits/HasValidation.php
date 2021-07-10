<?php

namespace Okipa\LaravelFormComponents\Components\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HasValidation
{
    public function getValidationClass(ViewErrorBag $errors, string|null $locale = null): string|null
    {
        $errorBag = $this->getErrorBag($errors);
        if ($errorBag->isEmpty()) {
            return null;
        }
        if ($locale && $errorBag->has($this->name . '.' . $locale)) {
            return $this->shouldDisplayValidationFailure() ? 'is-invalid' : null;
        }
        if ($errorBag->has($this->getNameWithArrayNotationConvertedInto())) {
            return $this->shouldDisplayValidationFailure() ? 'is-invalid' : null;
        }

        return $this->shouldDisplayValidationSuccess() ? 'is-valid' : null;
    }

    protected function getErrorBag(ViewErrorBag $errors): MessageBag
    {
        return $errors->{$this->errorBag};
    }

    public function shouldDisplayValidationFailure(): bool
    {
        return $this->displayValidationFailure ?? config('form-components.display_validation_failure', true);
    }

    public function shouldDisplayValidationSuccess(): bool
    {
        return $this->displayValidationSuccess ?? config('form-components.display_validation_success', true);
    }

    public function getErrorMessage(ViewErrorBag $errors, string|null $locale = null): string|null
    {
        if (! $this->shouldDisplayValidationFailure()) {
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
}
