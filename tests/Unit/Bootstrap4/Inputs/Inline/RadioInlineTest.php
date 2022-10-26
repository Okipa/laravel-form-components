<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Inline;

use Okipa\LaravelFormComponents\Components\Radio;

class RadioInlineTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Inline\RadioInlineTest
{
    /** @test */
    public function it_can_set_radio_stacked_mode_by_default_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
        ]);
        self::assertStringNotContainsString('class="custom-control custom-radio custom-control-inline', $html);
    }

    /** @test */
    public function it_can_set_radio_inlined_mode_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'inline' => true,
        ]);
        self::assertEquals(2, substr_count($html, ' class="custom-control custom-radio custom-control-inline'));
    }
}
