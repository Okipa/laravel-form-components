<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchLabelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_toggle_switch_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(
            '<label for="toggle-switch-active" class="form-check-label">validation.attributes.active</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_toggle_switch_label(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'label' => 'Test label']);
        self::assertStringContainsString(
            '<label for="toggle-switch-active" class="form-check-label">Test label</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_toggle_switch_label(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'hideLabel' => 'Test label']);
        self::assertStringNotContainsString('<label', $html);
    }
}
