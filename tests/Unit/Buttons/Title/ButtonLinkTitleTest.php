<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Buttons\Title;

use Okipa\LaravelFormComponents\Components\Button\Link;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ButtonLinkTitleTest extends TestCase
{
    /** @test */
    public function it_can_setup_button_link_default_title_from_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Link::class, [], ['slot' => '<i class="fas fa-sign-in-alt fa-fw"></i> Test']);
        self::assertStringContainsString(' title="Test"', $html);
    }

    /** @test */
    public function it_cant_setup_button_link_default_title_from_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Link::class);
        self::assertStringNotContainsString('title="', $html);
    }

    /** @test */
    public function it_can_set_button_link_custom_title(): void
    {
        $html = $this->renderComponent(Link::class, attributes: ['title' => 'Test title']);
        self::assertStringContainsString('title="Test title"', $html);
    }
}
