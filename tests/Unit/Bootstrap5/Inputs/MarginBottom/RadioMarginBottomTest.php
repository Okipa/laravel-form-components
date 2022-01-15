<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioMarginBottomTest extends TestCase
{
    /** @test */
    public function it_can_enable_radio_group_margin_bottom_by_default_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertEquals(1, substr_count($html, '<div class="mb-3">'));
    }

    /** @test */
    public function it_can_disable_radio_group_margin_bottom_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'marginBottom' => false,
        ]);
        self::assertStringNotContainsString('<div class="mb-3">', $html);
    }
}
