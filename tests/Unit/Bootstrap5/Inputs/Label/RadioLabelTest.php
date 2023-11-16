<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLabelTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_group_label_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertEquals(
            1,
            mb_substr_count($html, '<label class="form-label">validation.attributes.gender</label>')
        );
    }

    /** @test */
    public function it_can_set_radio_labels_in_group_mode(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(' class="form-check-label">Male</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Female</label>', $html);
    }
}
