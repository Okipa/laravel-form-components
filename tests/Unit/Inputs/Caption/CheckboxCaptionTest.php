<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_caption(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'caption' => 'Test caption']);
        self::assertStringContainsString('aria-describedby="checkbox-active-caption"', $html);
        self::assertStringContainsString(
            '<div id="checkbox-active-caption" class="form-text">Test caption</div>',
            $html
        );
    }
}
