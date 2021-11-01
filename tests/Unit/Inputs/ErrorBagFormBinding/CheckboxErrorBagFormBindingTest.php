<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\ErrorBagFormBinding;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxErrorBagFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_checkbox_form_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('active', 'Form error test');
        $componentMessageBag = app(MessageBag::class)->add('active', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('form_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('form_error_bag');
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'errorBag' => 'component_error_bag']);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }

    /** @test */
    public function it_can_override_checkboxes_form_error_bag_binding_from_component_error_bag_in_group_mode(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('technologies', 'Form error test');
        $componentMessageBag = app(MessageBag::class)->add('technologies', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('form_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('form_error_bag');
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'errorBag' => 'component_error_bag',
        ]);
        self::assertStringContainsString('<div class="invalid-feedback d-block">Component error test</div>', $html);
    }
}
