<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_input_caption(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'caption' => 'Test caption']);
        self::assertStringContainsString(' aria-describedby="text-first-name-caption"', $html);
        self::assertStringContainsString(
            '<div id="text-first-name-caption" class="form-text">Test caption</div>',
            $html
        );
    }
}
