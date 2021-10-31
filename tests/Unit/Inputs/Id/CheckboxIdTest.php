<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxIdTest extends TestCase
{
    /** @test */
    public function it_can_setup_checkbox_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' id="checkbox-active"', $html);
        self::assertStringContainsString(' for="checkbox-active"', $html);
    }

    /** @test */
    public function it_can_setup_checkboxes_default_id_when_none_is_defined_in_group_mode(): void
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
        self::assertStringContainsString(' id="checkbox-technologies-laravel"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-laravel"', $html);
        self::assertStringContainsString(' id="checkbox-technologies-bootstrap"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-bootstrap"', $html);
        self::assertStringContainsString(' id="checkbox-technologies-tailwind"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-tailwind"', $html);
        self::assertStringContainsString(' id="checkbox-technologies-livewire"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-livewire"', $html);
    }

    /** @test */
    public function it_can_setup_checkbox_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' id="checkbox-active-0"', $html);
        self::assertStringContainsString(' for="checkbox-active-0"', $html);
    }

    /** @test */
    public function it_can_setup_checkboxes_default_id_with_array_name_when_none_is_defined_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies[0]',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' id="checkbox-technologies-0-laravel"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-0-laravel"', $html);
        self::assertStringContainsString(' id="checkbox-technologies-0-bootstrap"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-0-bootstrap"', $html);
        self::assertStringContainsString(' id="checkbox-technologies-0-tailwind"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-0-tailwind"', $html);
        self::assertStringContainsString(' id="checkbox-technologies-0-livewire"', $html);
        self::assertStringContainsString(' for="checkbox-technologies-0-livewire"', $html);
    }

    /** @test */
    public function it_can_set_checkbox_id(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
        self::assertStringContainsString(' for="test-id"', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_ids_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'id' => 'test-id',
        ]);
        self::assertStringContainsString(' id="test-id-laravel"', $html);
        self::assertStringContainsString(' for="test-id-laravel"', $html);
        self::assertStringContainsString(' id="test-id-bootstrap"', $html);
        self::assertStringContainsString(' for="test-id-bootstrap"', $html);
        self::assertStringContainsString(' id="test-id-tailwind"', $html);
        self::assertStringContainsString(' for="test-id-tailwind"', $html);
        self::assertStringContainsString(' id="test-id-livewire"', $html);
        self::assertStringContainsString(' for="test-id-livewire"', $html);
    }
}
