<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Selected;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectSelectedTest extends TestCase
{
    /** @test */
    public function it_can_set_select_selected_from_model_in_single_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['hobby_id' => 2]);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $user,
            'selected' => 1,
        ]);
        self::assertStringContainsString('<option value="1" selected="selected">Music</option>', $html);
        self::assertStringContainsString('<option value="2">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_set_select_selected_from_model_in_multiple_mode_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['hobby_ids' => [2, 4]]);
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_ids',
                'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
                'bind' => $user,
                'selected' => [1, 3],
            ],
            attributes: ['multiple']
        );
        self::assertStringContainsString('<option value="1" selected="selected">Music</option>', $html);
        self::assertStringContainsString('<option value="2">Travels</option>', $html);
        self::assertStringContainsString('<option value="3" selected="selected">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }
}
