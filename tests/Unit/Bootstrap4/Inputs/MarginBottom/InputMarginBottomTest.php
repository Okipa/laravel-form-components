<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\Input;

class InputMarginBottomTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\MarginBottom\InputMarginBottomTest
{
    /** @test */
    public function it_can_enable_input_file_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'type' => 'file']);
        self::assertStringContainsString('<div class="custom-file mb-3">', $html);
    }
}
