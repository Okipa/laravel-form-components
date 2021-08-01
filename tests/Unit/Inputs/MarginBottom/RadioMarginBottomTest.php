<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioMarginBottomTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_enable_radio_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_disable_radio_margin_bottom(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'marginBottom' => false,
        ]);
        self::assertStringNotContainsString('mb-3', $html);
    }
}
