<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Input;

class InputLabelTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label\InputLabelTest
{
    /** @test */
    public function it_can_set_input_file_label_class(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'type' => 'file']);
        self::assertStringContainsString('<label for="file-first-name" class="custom-file-label">', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($labelPosition, $inputPosition);
    }
}
