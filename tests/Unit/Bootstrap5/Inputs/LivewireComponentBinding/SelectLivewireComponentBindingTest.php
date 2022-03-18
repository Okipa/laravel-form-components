<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\LivewireComponentBinding;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectLivewireComponentBindingTest extends TestCase
{
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
        self::assertStringContainsString(' wire:model.lazy="hobby_id"', $html);
    }

    /** @test */
    public function it_can_define_select_livewire_modifier_from_livewire_native_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
            attributes: ['wire:model.lazy' => 'hobby_id']
        );
        self::assertStringContainsString(' wire:model.lazy="hobby_id"', $html);
    }

    /** @test */
    public function it_can_override_select_form_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString(' wire:model.lazy="hobby_id"', $html);
    }

    /** @test */
    public function it_can_override_select_form_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
            attributes: ['wire' => true]
        );
        self::assertStringContainsString(' wire:model="hobby_id"', $html);
    }
}
