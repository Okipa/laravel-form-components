<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaCaptionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_textarea_caption(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'caption' => 'Test caption']);
        self::assertStringContainsString('aria-describedby="textarea-first-name-caption"', $html);
        self::assertStringContainsString(
            '<div id="textarea-first-name-caption" class="form-text">Test caption</div>',
            $html
        );
    }
}
