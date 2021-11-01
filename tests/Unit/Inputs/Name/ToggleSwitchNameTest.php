<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Name;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchNameTest extends TestCase
{
    /** @test */
    public function it_can_set_toggle_switch_name(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' name="active"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_name_in_group_mode(): void
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
        self::assertStringContainsString(' name="technologies[laravel]"', $html);
        self::assertStringContainsString(' name="technologies[bootstrap]"', $html);
        self::assertStringContainsString(' name="technologies[tailwind]"', $html);
        self::assertStringContainsString(' name="technologies[livewire]"', $html);
    }
}
