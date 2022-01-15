<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_toggle_switch_form_modifier_from_another_form_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="active"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model="active"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="active"', $html);
    }
}
