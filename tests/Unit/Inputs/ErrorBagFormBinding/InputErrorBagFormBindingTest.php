<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\ErrorBagFormBinding;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputErrorBagFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_input_global_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('first_name', 'Global error test');
        $componentMessageBag = app(MessageBag::class)->add('first_name', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('global_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('global_error_bag');
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'errorBag' => 'component_error_bag']);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
