<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioInlineTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_vertical_mode_by_default_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
        ]);
        self::assertStringNotContainsString(' class="form-check form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_radio_inline_mode_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'inline' => true,
        ]);
        self::assertEquals(2, substr_count($html, ' class="form-check form-check-inline'));
    }
}