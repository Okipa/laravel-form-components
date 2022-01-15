<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Checked;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioCheckedTest extends TestCase
{
    /** @test */
    public function it_can_set_radio_checked_status_from_int_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['gender' => 1]);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'bind' => $user,
            'checked' => '2',
        ]);
        self::assertStringContainsString(' value="2" checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_radio_checked_status_from_string_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['gender' => 'female']);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'bind' => $user,
            'checked' => 'male',
        ]);
        self::assertStringContainsString(' value="male" checked="checked"', $html);
    }
}
