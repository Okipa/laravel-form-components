<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_group_caption_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'caption' => 'Test caption',
        ]);
        self::assertEquals(2, substr_count($html, ' aria-describedby="radio-gender-caption"'));
        self::assertEquals(
            1,
            substr_count($html, '<div id="radio-gender-caption" class="form-text">Test caption</div>')
        );
    }
}
