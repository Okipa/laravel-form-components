<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchIdTest extends TestCase
{
    /** @test */
    public function it_can_setup_toggle_switch_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' id="toggle-switch-active"', $html);
        self::assertStringContainsString(' for="toggle-switch-active"', $html);
    }

    /** @test */
    public function it_can_setup_toggle_switches_default_id_when_none_is_defined_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' id="toggle-switch-technologies-laravel"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-laravel"', $html);
        self::assertStringContainsString(' id="toggle-switch-technologies-bootstrap"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-bootstrap"', $html);
        self::assertStringContainsString(' id="toggle-switch-technologies-tailwind"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-tailwind"', $html);
        self::assertStringContainsString(' id="toggle-switch-technologies-livewire"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-livewire"', $html);
    }

    /** @test */
    public function it_can_setup_toggle_switch_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' id="toggle-switch-active-0"', $html);
        self::assertStringContainsString(' for="toggle-switch-active-0"', $html);
    }

    /** @test */
    public function it_can_setup_toggle_switches_default_id_with_array_name_when_none_is_defined_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies[0]',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' id="toggle-switch-technologies-0-laravel"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-0-laravel"', $html);
        self::assertStringContainsString(' id="toggle-switch-technologies-0-bootstrap"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-0-bootstrap"', $html);
        self::assertStringContainsString(' id="toggle-switch-technologies-0-tailwind"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-0-tailwind"', $html);
        self::assertStringContainsString(' id="toggle-switch-technologies-0-livewire"', $html);
        self::assertStringContainsString(' for="toggle-switch-technologies-0-livewire"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switch_id(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
        self::assertStringContainsString(' for="test-id"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_ids_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'id' => 'test-id',
        ]);
        self::assertStringContainsString(' id="test-id-laravel"', $html);
        self::assertStringContainsString(' for="test-id-laravel"', $html);
        self::assertStringContainsString(' id="test-id-bootstrap"', $html);
        self::assertStringContainsString(' for="test-id-bootstrap"', $html);
        self::assertStringContainsString(' id="test-id-tailwind"', $html);
        self::assertStringContainsString(' for="test-id-tailwind"', $html);
        self::assertStringContainsString(' id="test-id-livewire"', $html);
        self::assertStringContainsString(' for="test-id-livewire"', $html);
    }
}
