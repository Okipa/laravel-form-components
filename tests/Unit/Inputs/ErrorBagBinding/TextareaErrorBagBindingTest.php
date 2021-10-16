<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\ErrorBagBinding;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaErrorBagBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_textarea_global_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('description', 'Global error test');
        $componentMessageBag = app(MessageBag::class)->add('description', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('global_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('global_error_bag');
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'errorBag' => 'component_error_bag']);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
