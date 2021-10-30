<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectLivewireFormBindingTest extends TestCase
{
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
        self::assertStringContainsString('wire:model.lazy="hobby_id"', $html);
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
            attributes: ['wire' => null]
        );
        self::assertStringContainsString('wire:model="hobby_id"', $html);
    }

    /** @test */
    public function it_can_override_select_form_modifier_with_another_form_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="hobby_id"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
        );
        self::assertStringContainsString('wire:model="hobby_id"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [],
            ],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="hobby_id"', $html);
    }
}
