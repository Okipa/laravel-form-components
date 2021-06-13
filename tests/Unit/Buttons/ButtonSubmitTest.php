<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Buttons;

use Okipa\LaravelFormComponents\Components\Button\Submit;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ButtonSubmitTest extends TestCase
{
    /** @test */
    public function it_can_setup_default_classes_when_none_are_defined(): void
    {
        $html = $this->renderComponent(Submit::class);
        self::assertStringContainsString('btn btn-primary', $html);
    }

    /** @test */
    public function it_can_set_custom_classes(): void
    {
        $html = $this->renderComponent(Submit::class, [], [], ['class' => 'btn-secondary']);
        self::assertStringContainsString('btn btn-secondary', $html);
    }

    /** @test */
    public function it_can_setup_default_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Submit::class);
        self::assertStringContainsString('Submit', $html);
    }

    /** @test */
    public function it_can_set_custom_slot(): void
    {
        $html = $this->renderComponent(Submit::class, [], ['slot' => 'Slot test']);
        self::assertStringContainsString('Slot test', $html);
    }
}
