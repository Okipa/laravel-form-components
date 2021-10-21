<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_radio_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire:model.lazy' => 'gender']
        );
        self::assertStringNotContainsString('name="gender"', $html);
    }

    /** @test */
    public function it_can_define_radio_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="gender"', $html);
    }

    /** @test */
    public function it_can_define_radio_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire:model.lazy' => 'gender']
        );
        self::assertStringContainsString('wire:model.lazy="gender"', $html);
    }
}
