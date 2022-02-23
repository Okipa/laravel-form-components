<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Input;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioInputTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_input_class(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString('<input id="radio-gender-female" class="form-check-input"', $html);
        self::assertStringContainsString('<input id="radio-gender-male" class="form-check-input"', $html);
    }
}
