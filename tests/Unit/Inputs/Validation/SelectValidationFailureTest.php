<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectValidationFailureTest extends TestCase
{
    /** @test */
    public function it_can_globally_set_display_select_validation_failure(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $component = app(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertTrue($component->shouldDisplayValidationFailure());
        config()->set('form-components.display_validation_failure', false);
        $component = app(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertFalse($component->shouldDisplayValidationFailure());
    }

    /** @test */
    public function it_can_display_select_validation_failure_when_allowed(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('hobby_id', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'displayValidationFailure' => true,
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_cant_display_select_validation_failure_when_disallowed(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $messageBag = app(MessageBag::class)->add('hobby_id', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'displayValidationFailure' => false,
        ]);
        self::assertStringNotContainsString(' is-invalid', $html);
        self::assertStringNotContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_select_validation_failure_from_array_name(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('hobby_id.0', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id[0]',
            'options' => [],
            'displayValidationFailure' => true,
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_can_display_select_validation_failure_from_custom_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('hobby_id', 'Error test');
        $errors = app(ViewErrorBag::class)->put('test_error_bag', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'displayValidationFailure' => true,
            'errorBag' => 'test_error_bag',
        ]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }
}
