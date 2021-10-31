<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_select_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
            attributes: ['wire:model.lazy' => 'hobby_id']
        );
        self::assertStringNotContainsString('name="', $html);
    }

    /** @test */
    public function it_cant_define_select_livewire_modifier_by_default(): void
    {
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_select_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="hobby_id"', $html);
    }

    /** @test */
    public function it_can_define_select_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
            attributes: ['wire:model.lazy' => 'hobby_id']
        );
        self::assertStringContainsString('wire:model.lazy="hobby_id"', $html);
    }
}
