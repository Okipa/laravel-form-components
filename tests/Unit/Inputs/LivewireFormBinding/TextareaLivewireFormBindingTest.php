<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_textarea_form_livewire_modifier_binding_from_another_form_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
        );
        self::assertStringContainsString(' wire:model.debounce.150ms="description"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
        );
        self::assertStringContainsString(' wire:model="description"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
        );
        self::assertStringContainsString(' wire:model.debounce.150ms="description"', $html);
    }
}
