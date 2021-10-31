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
        $user = app(User::class)->forceFill(['hobbies' => [1, 4]]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
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
        $user = ['hobbies' => [1, 4]];
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
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
        $user = collect(['hobbies' => [1, 4]]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
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
        $user = (object) ['hobbies' => [1, 4]];
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
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
    public function it_can_override_checkbox_form_data_binding_from_component_bound_data_in_group_mode(): void
    {
        $formBoundModel = app(User::class)->forceFill(['hobbies' => [1, 4]]);
        $componentBoundModel = app(User::class)->forceFill(['hobbies' => [2, 3]]);
        app(FormBinder::class)->bindNewDataBatch($formBoundModel);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $componentBoundModel,
        ]);
        self::assertStringContainsString(' name="hobbies[2]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[3]" checked="checked"', $html);
    }
}
