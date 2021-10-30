<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxInlineTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_vertical_mode_by_default(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringNotContainsString(' class="form-check form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_checkbox_inline_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'inline' => true]);
        self::assertStringContainsString(' class="form-check form-check-inline', $html);
    }
}
