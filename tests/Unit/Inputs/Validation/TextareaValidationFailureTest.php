<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaValidationFailureTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_globally_set_display_textarea_validation_failure(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $component = app(Textarea::class, ['name' => 'description']);
        self::assertTrue($component->displayValidationFailure);
        config()->set('form-components.display_validation_failure', false);
        $component = app(Textarea::class, ['name' => 'description']);
        self::assertFalse($component->displayValidationFailure);
    }

    /** @test */
    public function it_can_display_textarea_validation_failure_when_allowed(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('description', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'displayValidationFailure' => true,
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_textarea_localized_validation_failure(): void
    {
        $messageBag = app(MessageBag::class)->add('description.fr', 'Test description.fr error message.');
        $messageBag->add('description.en', 'Test description.en error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'displayValidationFailure' => true,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(
            '<div class="invalid-feedback">Test validation.attributes.description (FR) error message.</div>',
            $html
        );
        self::assertStringContainsString(
            '<div class="invalid-feedback">Test validation.attributes.description (EN) error message.</div>',
            $html
        );
    }

    /** @test */
    public function it_cant_display_textarea_validation_failure_when_disallowed(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $messageBag = app(MessageBag::class)->add('description', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'displayValidationFailure' => false,
        ]);
        self::assertStringNotContainsString(' is-invalid', $html);
        self::assertStringNotContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_textarea_validation_failure_from_array_name(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('description.0', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description[0]',
            'displayValidationFailure' => true,
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_textarea_validation_failure_from_custom_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('description', 'Error test');
        $errors = app(ViewErrorBag::class)->put('test_error_bag', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'displayValidationFailure' => true,
            'errorBag' => 'test_error_bag',
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }
}
