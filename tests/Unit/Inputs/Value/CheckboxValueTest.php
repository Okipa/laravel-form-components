<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Value;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxValueTest extends TestCase
{
    /** @test */
    public function it_can_set_checkboxes_values_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' value="laravel"', $html);
        self::assertStringContainsString(' value="bootstrap"', $html);
        self::assertStringContainsString(' value="tailwind"', $html);
        self::assertStringContainsString(' value="livewire"', $html);
    }
}
