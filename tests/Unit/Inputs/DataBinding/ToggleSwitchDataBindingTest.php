<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBindings;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchDataBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

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
    public function it_can_override_global_toggle_switch_binding_by_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['active' => false]);
        $directBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(ToggleSwitch::class, ['name' => 'active', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->active, $component->getChecked());
    }
}
