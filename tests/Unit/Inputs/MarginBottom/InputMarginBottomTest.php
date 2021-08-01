<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputMarginBottomTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_enable_input_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_disable_input_margin_bottom(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'marginBottom' => false]);
        self::assertStringNotContainsString('mb-3', $html);
    }
}
