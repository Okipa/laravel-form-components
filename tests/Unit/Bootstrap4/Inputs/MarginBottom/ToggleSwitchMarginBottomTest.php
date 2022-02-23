<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;

class ToggleSwitchMarginBottomTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\MarginBottom\ToggleSwitchMarginBottomTest
{
    /** @test */
    public function it_can_enable_toggle_switch_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString('<div class="custom-control custom-switch mb-3">', $html);
    }

    /** @test */
    public function it_can_disable_toggle_switch_margin_bottom(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'marginBottom' => false]);
        self::assertStringNotContainsString('<div class="custom-control custom-switch mb-3">', $html);
    }
}
