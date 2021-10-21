<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_toggle_switch_checked_status_from_direct_bound_model(): void
    {
        $user = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $user]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_direct_bound_array(): void
    {
        $data = ['active' => true];
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_direct_bound_collection(): void
    {
        $data = collect(['active' => true]);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_direct_bound_object(): void
    {
        $data = (object) ['active' => true];
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_global_bound_model(): void
    {
        $user = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($user);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_global_bound_array(): void
    {
        $data = ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_global_bound_collection(): void
    {
        $data = collect(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_global_bound_object(): void
    {
        $data = (object) ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_toggle_switch_global_data_binding_from_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['active' => false]);
        $directBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(ToggleSwitch::class, ['name' => 'active', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->active, $component->getChecked());
    }

    /** @test */
    public function it_can_override_toggle_switch_global_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('active', 'Global error test');
        $componentMessageBag = app(MessageBag::class)->add('active', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('global_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('global_error_bag');
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'active',
            'errorBag' => 'component_error_bag'
        ]);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
