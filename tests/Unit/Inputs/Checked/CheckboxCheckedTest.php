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
}
