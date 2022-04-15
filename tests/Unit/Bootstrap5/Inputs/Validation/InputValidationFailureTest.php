<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputValidationFailureTest extends TestCase
{
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
        $this->assertSeeHtmlInOrder($html, [
            '<input',
            ' class="form-control is-invalid"',
            '<div class="invalid-feedback">Error test</div>',
        ]);
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
        $this->assertSeeHtmlInOrder($html, [
            '<input',
            ' class="',
            ' is-invalid',
            '<div class="invalid-feedback">Test validation.attributes.first_name (FR) error message.</div>',
            '<input',
            ' class="',
            ' is-invalid',
            '<div class="invalid-feedback">Test validation.attributes.first_name (EN) error message.</div>',
        ]);
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
        $this->assertDontSeeHtml($html, [
            'is-invalid',
            '<div class="invalid-feedback">Error test</div>',
        ]);
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
        $this->assertSeeHtmlInOrder($html, [
            '<input',
            ' class="',
            ' is-invalid',
            '<div class="invalid-feedback">Error test</div>',
        ]);
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
        $this->assertSeeHtmlInOrder($html, [
            '<input',
            ' class="',
            ' is-invalid',
            '<div class="invalid-feedback">Error test</div>',
        ]);
    }
}
