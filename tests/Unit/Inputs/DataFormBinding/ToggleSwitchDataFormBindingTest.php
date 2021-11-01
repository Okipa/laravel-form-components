<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_form_bound_model(): void
    {
        $user = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($user);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_form_bound_model_in_group_mode(): void
    {
        $bind = app(User::class)->forceFill(['technologies' => ['laravel', 'livewire']]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' value="laravel" checked="checked"', $html);
        self::assertStringContainsString(' value="livewire" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_form_bound_array(): void
    {
        $data = ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_form_bound_array_in_group_mode(): void
    {
        $bind = ['technologies' => ['laravel', 'livewire']];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' value="laravel" checked="checked"', $html);
        self::assertStringContainsString(' value="livewire" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_form_bound_collection(): void
    {
        $data = collect(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_form_bound_collection_in_group_mode(): void
    {
        $bind = collect(['technologies' => ['laravel', 'livewire']]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' value="laravel" checked="checked"', $html);
        self::assertStringContainsString(' value="livewire" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_value_from_form_bound_object(): void
    {
        $data = (object) ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switches_checked_status_from_form_bound_object_in_group_mode(): void
    {
        $bind = (object) ['technologies' => ['laravel', 'livewire']];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' value="laravel" checked="checked"', $html);
        self::assertStringContainsString(' value="livewire" checked="checked"', $html);
    }
}
