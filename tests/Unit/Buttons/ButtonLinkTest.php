<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Buttons;

use Okipa\LaravelFormComponents\Components\Button\Link;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ButtonLinkTest extends TestCase
{
    /** @test */
    public function it_can_setup_default_classes_when_none_are_defined(): void
    {
        $html = $this->renderComponent(Link::class);
        self::assertStringContainsString('btn btn-primary', $html);
    }

    /** @test */
    public function it_can_set_custom_classes(): void
    {
        $html = $this->renderComponent(Link::class, [], [], ['class' => 'btn-secondary']);
        self::assertStringContainsString('btn btn-secondary', $html);
    }

    /** @test */
    public function it_can_setup_default_title_from_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Link::class, [], ['slot' => '<i class="fas fa-sign-in-alt fa-fw"></i> Test']);
        self::assertStringContainsString(' title="Test"', $html);
    }

    /** @test */
    public function it_cant_setup_default_title_from_slot_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Link::class);
        self::assertStringNotContainsString('title="', $html);
    }

    /** @test */
    public function it_can_set_custom_title(): void
    {
        $html = $this->renderComponent(Link::class, attributes: ['title' => 'Test title']);
        self::assertStringContainsString('title="Test title"', $html);
    }
}
