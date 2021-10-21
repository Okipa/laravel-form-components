<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_textarea_caption(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'caption' => 'Test caption']);
        self::assertStringContainsString('aria-describedby="textarea-description-caption"', $html);
        self::assertStringContainsString(
            '<div id="textarea-description-caption" class="form-text">Test caption</div>',
            $html
        );
    }
}
