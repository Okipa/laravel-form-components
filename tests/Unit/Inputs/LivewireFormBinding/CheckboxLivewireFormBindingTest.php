<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_checkbox_form_livewire_modifier_binding_from_another_form_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="active"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model="active"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="active"', $html);
    }
}
