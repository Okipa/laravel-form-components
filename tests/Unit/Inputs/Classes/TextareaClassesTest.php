<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Classes;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaClassesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_component_classes_on_textarea(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString(' class="component-container mb-3"', $html);
        self::assertStringContainsString(' class="component ', $html);
    }
}
