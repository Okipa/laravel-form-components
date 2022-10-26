<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Radio;

class RadioLabelTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label\RadioLabelTest
{
    /** @test */
    public function it_can_set_radio_labels_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(' class="custom-control-label">Male</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Female</label>', $html);
    }
}
