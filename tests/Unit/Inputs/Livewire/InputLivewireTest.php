<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_input_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire:model.lazy' => 'first_name']
        );
        self::assertStringNotContainsString('name="', $html);
    }

    /** @test */
    public function it_can_remove_input_value_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString('value="', $html);
    }

    /** @test */
    public function it_cant_define_input_livewire_modifier_by_default(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_input_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="first_name"', $html);
    }

    /** @test */
    public function it_can_define_input_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire:model.lazy' => 'first_name']
        );
        self::assertStringContainsString('wire:model.lazy="first_name"', $html);
    }
}
