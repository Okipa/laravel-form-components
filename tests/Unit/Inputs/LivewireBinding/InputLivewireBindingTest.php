<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputLivewireBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_input_global_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire:model.lazy' => 'first_name']
        );
        self::assertStringContainsString('wire:model.lazy="first_name"', $html);
        self::assertStringNotContainsString('name="first_name"', $html);
        self::assertStringNotContainsString('value="', $html);
    }
}
