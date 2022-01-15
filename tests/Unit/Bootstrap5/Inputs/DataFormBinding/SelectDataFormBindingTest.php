<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_form_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['hobby_id' => 2]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            ],
            attributes: ['multiple']
        );
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_from_form_bound_array(): void
    {
        $bind = ['hobby_id' => 2];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: [
                'name' => 'hobby_id',
                'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            ],
            attributes: ['multiple']
        );
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_form_bound_collection(): void
    {
        $bind = collect(['hobby_id' => 2]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_form_bound_object(): void
    {
        $bind = (object) ['hobby_id' => 2];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }
}
