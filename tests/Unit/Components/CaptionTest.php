<?php

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CaptionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_input_caption(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'caption' => 'Test caption']);
        self::assertStringContainsString('aria-describedby="text-first-name-caption"', $html);
        self::assertStringContainsString(
            '<div id="text-first-name-caption" class="form-text">Test caption</div>',
            $html
        );
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
