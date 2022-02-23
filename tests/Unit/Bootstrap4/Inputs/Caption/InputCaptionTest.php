<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Input;

class InputCaptionTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption\InputCaptionTest
{
    /** @test */
    public function it_can_set_input_caption(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'caption' => 'Test caption']);
        self::assertStringContainsString(' aria-describedby="text-first-name-caption"', $html);
        self::assertStringContainsString(
            '<small id="text-first-name-caption" class="form-text text-muted">Test caption</small>',
            $html
        );
    }
}
