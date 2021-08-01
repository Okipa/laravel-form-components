<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectMarginBottomTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_enable_select_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_disable_select_margin_bottom(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'marginBottom' => false,
        ]);
        self::assertStringNotContainsString('mb-3', $html);
    }
}
