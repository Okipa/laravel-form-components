<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Classes;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchClassesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_component_classes_on_toggle_switch(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' class="component-container ', $html);
        self::assertStringContainsString(' class="component ', $html);
    }
}
