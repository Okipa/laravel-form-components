<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_radio_name_html_attribute_when_wired_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire:model.lazy' => 'gender']
        );
        self::assertStringNotContainsString(' name="', $html);
    }

    /** @test */
    public function it_cant_define_radio_livewire_modifier_by_default_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_radio_livewire_modifier_from_name_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire' => 'lazy']
        );
        self::assertEquals(2, substr_count($html, ' wire:model.lazy="gender"'));
    }

    /** @test */
    public function it_can_define_radio_livewire_modifier_from_livewire_normal_binding_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire:model.lazy' => 'gender']
        );
        self::assertEquals(2, substr_count($html, ' wire:model.lazy="gender"'));
    }
}
