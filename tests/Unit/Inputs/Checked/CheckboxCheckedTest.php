<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxCheckedTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_checked_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['active' => false]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'active',
            'bind' => $user,
            'checked' => true,
        ]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_checked_from_int_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['hobbies' => [1, 4]]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
            'checked' => ['2', 3],
        ]);
        self::assertStringContainsString(' name="hobbies[2]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[3]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_checked_from_string_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['hobbies' => ['laravel', 'tailwind']]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'hobbies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
            'checked' => ['bootstrap', 'livewire'],
        ]);
        self::assertStringContainsString(' name="hobbies[bootstrap]" checked="checked"', $html);
        self::assertStringContainsString(' name="hobbies[livewire]" checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_checkbox_unchecked_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'active',
            'bind' => $user,
            'checked' => false,
        ]);
        self::assertStringNotContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_unchecked_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['hobbies' => [1, 4]]);
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'active',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
            'checked' => [],
        ]);
        self::assertStringNotContainsString(' checked="checked"', $html);
    }
}
