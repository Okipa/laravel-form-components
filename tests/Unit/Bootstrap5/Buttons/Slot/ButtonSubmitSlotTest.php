<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Buttons\Slot;

use Illuminate\Support\HtmlString;
use Okipa\LaravelFormComponents\Components\Button\Submit;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ButtonSubmitSlotTest extends TestCase
{
    /** @test */
    public function it_can_setup_default_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(
            componentClass: Submit::class,
            viewData: ['slot' => new HtmlString()]
        );
        self::assertStringContainsString('Submit', $html);
    }

    /** @test */
    public function it_can_set_custom_slot(): void
    {
        $html = $this->renderComponent(
            componentClass: Submit::class,
            viewData: ['slot' => new HtmlString('Slot test')]
        );
        self::assertStringContainsString('Slot test', $html);
    }
}
