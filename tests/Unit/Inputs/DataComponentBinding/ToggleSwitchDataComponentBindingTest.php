<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Checkbox;
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
    public function it_can_retrieve_toggle_switches_checked_status_from_component_bound_model_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['technologies' => ['laravel', 'livewire']]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="technologies[laravel]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[livewire]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_component_bound_array(): void
    {
        $data = ['active' => true];
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_component_bound_array_in_group_mode(): void
    {
        $user = ['technologies' => ['laravel', 'livewire']];
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="technologies[laravel]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[livewire]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_component_bound_collection(): void
    {
        $data = collect(['active' => true]);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_component_bound_collection_in_group_mode(): void
    {
        $user = collect(['technologies' => ['laravel', 'livewire']]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="technologies[laravel]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[livewire]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_component_bound_object(): void
    {
        $data = (object) ['active' => true];
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'bind' => $data]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_component_bound_object_in_group_mode(): void
    {
        $user = (object) ['technologies' => ['laravel', 'livewire']];
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="technologies[laravel]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[livewire]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_toggle_switch_form_data_binding_from_component_bound_data(): void
    {
        $formBoundModel = app(User::class)->forceFill(['active' => false]);
        $componentBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($formBoundModel);
        $component = app(ToggleSwitch::class, ['name' => 'active', 'bind' => $componentBoundModel]);
        self::assertEquals($componentBoundModel->active, $component->getSingleModeCheckedStatus());
    }

    /** @test */
    public function it_can_override_toggle_switches_form_data_binding_from_component_bound_data_in_group_mode(): void
    {
        $formBoundModel = app(User::class)->forceFill(['technologies' => ['laravel', 'livewire']]);
        $componentBoundModel = app(User::class)->forceFill(['technologies' => ['bootstrap', 'tailwind']]);
        app(FormBinder::class)->bindNewDataBatch($formBoundModel);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $componentBoundModel,
        ]);
        self::assertStringContainsString(' name="technologies[bootstrap]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[tailwind]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_component_bound_int_in_group_mode(): void
    {
        $bind = app(User::class)->forceFill(['technologies' => ['1', 4]]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' name="technologies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[4]" checked="checked"', $html);
    }
}
