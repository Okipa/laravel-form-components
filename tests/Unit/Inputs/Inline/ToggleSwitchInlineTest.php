<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchInlineTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_stacked_mode_by_default(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringNotContainsString(' class="form-check form-switch form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_checkbox_inlined_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'inline' => true]);
        self::assertStringContainsString(' class="form-check form-switch form-check-inline', $html);
    }
}
