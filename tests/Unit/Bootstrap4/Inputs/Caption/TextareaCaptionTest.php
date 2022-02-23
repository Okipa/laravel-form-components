<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Textarea;

class TextareaCaptionTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption\TextareaCaptionTest
{
    /** @test */
    public function it_can_set_textarea_caption(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'caption' => 'Test caption']);
        self::assertStringContainsString(' aria-describedby="textarea-description-caption"', $html);
        self::assertStringContainsString(
            '<small id="textarea-description-caption" class="form-text text-muted">Test caption</small>',
            $html
        );
    }
}
