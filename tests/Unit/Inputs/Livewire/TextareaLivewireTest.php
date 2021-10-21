<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_textarea_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'description'],
            attributes: ['wire:model.lazy' => 'description']
        );
        self::assertStringNotContainsString('name="description"', $html);
    }

    /** @test */
    public function it_can_remove_textarea_value_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'description'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString('value="', $html);
    }

    /** @test */
    public function it_can_define_textarea_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'description'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="description"', $html);
    }

    /** @test */
    public function it_can_define_textarea_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'description'],
            attributes: ['wire:model.lazy' => 'description']
        );
        self::assertStringContainsString('wire:model.lazy="description"', $html);
    }
}
