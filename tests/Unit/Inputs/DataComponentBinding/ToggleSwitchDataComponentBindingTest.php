<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchDataComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_toggle_switch_checked_status_from_component_bound_model(): void
    {
        $user = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $user]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_component_bound_array(): void
    {
        $data = ['active' => true];
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_component_bound_collection(): void
    {
        $data = collect(['active' => true]);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_component_bound_object(): void
    {
        $data = (object) ['active' => true];
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_toggle_switch_form_data_binding_from_component_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['active' => false]);
        $directBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(ToggleSwitch::class, ['name' => 'active', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->active, $component->getChecked());
    }
}
