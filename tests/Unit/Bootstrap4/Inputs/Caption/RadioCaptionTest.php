<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Radio;

class RadioCaptionTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption\RadioCaptionTest
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
            substr_count($html, '<small id="radio-gender-caption" class="form-text text-muted">Test caption</small>')
        );
    }
}
