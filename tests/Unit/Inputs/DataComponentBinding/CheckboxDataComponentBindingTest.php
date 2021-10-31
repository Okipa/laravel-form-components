<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxDataComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_component_bound_model_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['technologies' => ['laravel', 'livewire']]);
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
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_array(): void
    {
        $bind = ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_component_bound_array_in_group_mode(): void
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
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_component_bound_collection_in_group_mode(): void
    {
        $user = collect(['technologies' => ['laravel', 'livewire']]);
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
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_object(): void
    {
        $bind = (object) ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_component_bound_object_in_group_mode(): void
    {
        $user = (object) ['technologies' => ['laravel', 'livewire']];
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
    public function it_can_override_checkbox_form_data_binding_from_component_bound_data(): void
    {
        $formBoundModel = app(User::class)->forceFill(['active' => false]);
        $componentBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($formBoundModel);
        $component = app(Checkbox::class, ['name' => 'active', 'bind' => $componentBoundModel]);
        self::assertEquals($componentBoundModel->active, $component->getSingleModeCheckedStatus());
    }

    /** @test */
    public function it_can_override_checkboxes_form_data_binding_from_component_bound_data_in_group_mode(): void
    {
        $formBoundModel = app(User::class)->forceFill(['technologies' => ['laravel', 'livewire']]);
        $componentBoundModel = app(User::class)->forceFill(['technologies' => ['bootstrap', 'tailwind']]);
        app(FormBinder::class)->bindNewDataBatch($formBoundModel);
        $html = $this->renderComponent(Checkbox::class, [
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
    public function it_can_retrieve_checkboxes_checked_status_from_component_bound_int_in_group_mode(): void
    {
        $bind = app(User::class)->forceFill(['technologies' => ['1', 4]]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' name="technologies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[4]" checked="checked"', $html);
    }
}
