<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLabelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_radio_label(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(
            ' class="form-check-label">Male</label>',
            $html
        );
        self::assertStringContainsString(
            ' class="form-check-label">Female</label>',
            $html
        );
    }
}
