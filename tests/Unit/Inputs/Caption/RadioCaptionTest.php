<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_caption(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'caption' => 'Test caption',
        ]);
        self::assertStringContainsString('aria-describedby="radio-gender-caption"', $html);
        self::assertStringContainsString(
            '<div id="radio-gender-caption" class="form-text">Test caption</div>',
            $html
        );
    }
}
