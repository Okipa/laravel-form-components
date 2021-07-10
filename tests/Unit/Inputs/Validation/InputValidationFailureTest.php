<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputValidationFailureTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_globally_set_display_input_validation_failure(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $component = app(Input::class, ['name' => 'first_name']);
        self::assertTrue($component->shouldDisplayValidationFailure());
        config()->set('form-components.display_validation_failure', false);
        $component = app(Input::class, ['name' => 'first_name']);
        self::assertFalse($component->shouldDisplayValidationFailure());
    }

    /** @test */
    public function it_can_display_input_validation_failure_when_allowed(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('first_name', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'displayValidationFailure' => true,
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_input_localized_validation_failure(): void
    {
        $messageBag = app(MessageBag::class)->add('first_name.fr', 'Test first name.fr error message.');
        $messageBag->add('first_name.en', 'Test first name.en error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'displayValidationFailure' => true,
            'locales' => ['fr', 'en'],
        ]);
        self::assertEquals(2, substr_count($html, ' is-invalid'));
        self::assertStringContainsString(
            '<div class="invalid-feedback">Test validation.attributes.first_name (FR) error message.</div>',
            $html
        );
        self::assertStringContainsString(
            '<div class="invalid-feedback">Test validation.attributes.first_name (EN) error message.</div>',
            $html
        );
    }

    /** @test */
    public function it_cant_display_input_validation_failure_when_disallowed(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $messageBag = app(MessageBag::class)->add('first_name', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'displayValidationFailure' => false,
        ]);
        self::assertStringNotContainsString(' is-invalid', $html);
        self::assertStringNotContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_input_validation_failure_from_array_name(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('first_name.0', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name[0]',
            'displayValidationFailure' => true,
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_input_validation_failure_from_custom_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('first_name', 'Error test');
        $errors = app(ViewErrorBag::class)->put('test_error_bag', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'displayValidationFailure' => true,
            'errorBag' => 'test_error_bag',
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }
}
