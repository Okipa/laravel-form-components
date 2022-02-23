<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Input;

use Okipa\LaravelFormComponents\Components\Input;

class InputTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Input\InputTest
{
    /** @test */
    public function it_can_set_input_file_class(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'document', 'type' => 'file']);
        self::assertStringContainsString('<input id="file-document" class="custom-file-input"', $html);
    }

    /** @test */
    public function it_can_add_div_wrapper_for_input_file(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'type' => 'file']);
        self::assertStringContainsString('<div class="custom-file">', $html);
    }
}
