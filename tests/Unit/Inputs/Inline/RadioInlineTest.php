<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioInlineTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_vertical_mode_by_default(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
        ]);
        self::assertStringNotContainsString(' class="form-check form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_radio_inline_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'inline' => true,
        ]);
        self::assertStringContainsString(' class="form-check form-check-inline', $html);
    }
}
