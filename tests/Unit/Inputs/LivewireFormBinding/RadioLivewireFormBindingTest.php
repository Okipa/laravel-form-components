<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_radio_form_livewire_modifier_binding_from_another_form_null_modifier_in_group_mode(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertEquals(2, substr_count($html, ' wire:model.debounce.150ms="gender"'));
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertEquals(2, substr_count($html, ' wire:model="gender"'));
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertEquals(2, substr_count($html, ' wire:model.debounce.150ms="gender"'));
    }
}
