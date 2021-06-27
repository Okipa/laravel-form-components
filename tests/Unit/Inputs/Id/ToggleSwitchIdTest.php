<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_toggle_switch_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' id="toggle-switch-active"', $html);
    }

    /** @test */
    public function it_can_setup_toggle_switch_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' id="toggle-switch-active-0"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switch_id(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
    }
}
