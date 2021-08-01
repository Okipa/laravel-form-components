<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaMarginBottomTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

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
