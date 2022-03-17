<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Placeholder;

use Okipa\LaravelFormComponents\Components\Input;

class InputPlaceholderTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Placeholder\InputPlaceholderTest
{
    /** @test */
    public function it_can_set_input_file_placeholder(): void
    {
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'type' => 'file',
            'placeholder' => 'Test placeholder'
        ]);
        $this->assertSeeHtmlInOrder($html, [
            '<input',
            '<label for="file-first-name" class="custom-file-label">Test placeholder</label>',
        ]);
    }
}
