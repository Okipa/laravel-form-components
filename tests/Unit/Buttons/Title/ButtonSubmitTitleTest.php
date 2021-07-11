<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Buttons;

use Okipa\LaravelFormComponents\Components\Button\Submit;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ButtonSubmitTitleTest extends TestCase
{
    /** @test */
    public function it_can_setup_button_submit_default_title_from_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Submit::class, [], ['slot' => '<i class="fas fa-sign-in-alt fa-fw"></i> Test']);
        self::assertStringContainsString(' title="Test"', $html);
    }

    /** @test */
    public function it_can_set_button_submit_custom_title(): void
    {
        $html = $this->renderComponent(Submit::class, attributes: ['title' => 'Test title']);
        self::assertStringContainsString('title="Test title"', $html);
    }
}
