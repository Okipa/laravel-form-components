<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectMarginBottomTest extends TestCase
{
    /** @test */
    public function it_can_enable_select_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString('<div class="mb-3">', $html);
    }

    /** @test */
    public function it_can_disable_select_margin_bottom(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'marginBottom' => false,
        ]);
        self::assertStringNotContainsString('<div class="mb-3">', $html);
    }
}
