<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaMarginBottomTest extends TestCase
{
    /** @test */
    public function it_can_enable_textarea_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_disable_textarea_margin_bottom(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'marginBottom' => false]);
        self::assertStringNotContainsString('mb-3', $html);
    }
}
