<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxMarginBottomTest extends TestCase
{
    /** @test */
    public function it_can_enable_checkbox_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_disable_checkbox_margin_bottom(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'marginBottom' => false]);
        self::assertStringNotContainsString('mb-3', $html);
    }
}
