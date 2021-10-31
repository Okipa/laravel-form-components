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
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
        ]);
        self::assertStringContainsString(' id="checkbox-hobbies-1"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-1"', $html);
        self::assertStringContainsString(' id="checkbox-hobbies-2"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-2"', $html);
        self::assertStringContainsString(' id="checkbox-hobbies-3"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-3"', $html);
        self::assertStringContainsString(' id="checkbox-hobbies-4"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-4"', $html);
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
            'name' => 'hobbies[0]',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
        ]);
        self::assertStringContainsString(' id="checkbox-hobbies-0-1"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-0-1"', $html);
        self::assertStringContainsString(' id="checkbox-hobbies-0-2"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-0-2"', $html);
        self::assertStringContainsString(' id="checkbox-hobbies-0-3"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-0-3"', $html);
        self::assertStringContainsString(' id="checkbox-hobbies-0-4"', $html);
        self::assertStringContainsString(' for="checkbox-hobbies-0-4"', $html);
    }

    /** @test */
    public function it_can_set_checkbox_id(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
        self::assertStringContainsString(' for="test-id"', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_id_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'id' => 'test-id',
        ]);
        self::assertStringContainsString(' id="test-id-1"', $html);
        self::assertStringContainsString(' for="test-id-1"', $html);
        self::assertStringContainsString(' id="test-id-2"', $html);
        self::assertStringContainsString(' for="test-id-2"', $html);
        self::assertStringContainsString(' id="test-id-3"', $html);
        self::assertStringContainsString(' for="test-id-3"', $html);
        self::assertStringContainsString(' id="test-id-4"', $html);
        self::assertStringContainsString(' for="test-id-4"', $html);
    }
}
