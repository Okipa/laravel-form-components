<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_form_bound_model_in_group_mode(): void
    {
        $bind = app(User::class)->forceFill(['hobbies' => [1, 4]]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_array(): void
    {
        $bind = ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_form_bound_array_in_group_mode(): void
    {
        $bind = ['hobbies' => [1, 4]];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_form_bound_collection_in_group_mode(): void
    {
        $bind = collect(['hobbies' => [1, 4]]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_object(): void
    {
        $bind = (object) ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_checked_status_from_form_bound_object_in_group_mode(): void
    {
        $bind = (object) ['hobbies' => [1, 4]];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
        ]);
        self::assertStringContainsString(' name="hobbies[1]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[4]" checked="checked"', $html);
    }
}
