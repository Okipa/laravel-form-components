<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBindings;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxDataBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_direct_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_direct_bound_array(): void
    {
        $bind = ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_direct_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_direct_bound_object(): void
    {
        $bind = (object) ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_array(): void
    {
        $bind = ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_object(): void
    {
        $bind = (object) ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_checkbox_global_data_binding_from_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['active' => false]);
        $directBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(Checkbox::class, ['name' => 'active', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->active, $component->getChecked());
    }

    /** @test */
    public function it_can_override_checkbox_global_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('active', 'Global error test');
        $componentMessageBag = app(MessageBag::class)->add('active', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('global_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('global_error_bag');
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'errorBag' => 'component_error_bag']);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
