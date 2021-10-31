<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\ErrorBagFormBinding;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectErrorBagFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_select_form_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('hobby_id', 'Form error test');
        $componentMessageBag = app(MessageBag::class)->add('hobby_id', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('form_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('form_error_bag');
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'errorBag' => 'component_error_bag',
        ]);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
