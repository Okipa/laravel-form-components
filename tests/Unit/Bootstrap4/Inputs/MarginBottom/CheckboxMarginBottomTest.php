<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Checkbox;

class CheckboxMarginBottomTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\MarginBottom\CheckboxMarginBottomTest
{
    /** @test */
    public function it_can_enable_checkbox_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString('<div class="custom-control custom-checkbox mb-3">', $html);
    }
}
