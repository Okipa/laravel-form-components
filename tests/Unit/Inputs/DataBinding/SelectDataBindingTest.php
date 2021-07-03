<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectDataBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_direct_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['hobby_id' => 2]);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_direct_bound_array(): void
    {
        $bind = ['hobby_id' => 2];
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_direct_bound_collection(): void
    {
        $bind = collect(['hobby_id' => 2]);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_direct_bound_object(): void
    {
        $bind = (object) ['hobby_id' => 2];
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_options_in_multiple_mode_from_direct_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['hobby_ids' => [2, 4]]);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_ids',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4" selected="selected">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_options_in_multiple_mode_from_direct_bound_array(): void
    {
        $bind = ['hobby_ids' => [2, 4]];
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_ids',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4" selected="selected">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_options_in_multiple_mode_from_direct_bound_collection(): void
    {
        $bind = collect(['hobby_ids' => [2, 4]]);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_ids',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4" selected="selected">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_options_in_multiple_mode_from_direct_bound_object(): void
    {
        $bind = (object) ['hobby_ids' => [2, 4]];
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_ids',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4" selected="selected">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['hobby_id' => 2]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ], attributes: ['multiple']);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_from_global_bound_array(): void
    {
        $bind = ['hobby_id' => 2];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ], attributes: ['multiple']);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_selected_option_in_single_mode_from_global_bound_collection(): void
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
    public function it_can_retrieve_select_selected_option_in_single_mode_from_global_bound_object(): void
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

    /** @test */
    public function it_can_override_global_select_binding_by_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['hobby_id' => 1]);
        $directBoundModel = app(User::class)->forceFill(['hobby_id' => 2]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
            'bind' => $directBoundModel
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }
}