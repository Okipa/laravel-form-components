<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioDataDirectBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_radio_checked_status_from_component_bound_model_in_group_mode(): void
    {
        $bind = app(User::class)->forceFill(['gender' => 'female']);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_checked_status_from_component_bound_array_in_group_mode(): void
    {
        $bind = ['gender' => 'female'];
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_checked_status_from_component_bound_collection_in_group_mode(): void
    {
        $bind = collect(['gender' => 'female']);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_checked_status_from_component_bound_object_in_group_mode(): void
    {
        $bind = (object) ['gender' => 'female'];
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_radio_form_data_binding_from_component_bound_data_in_group_mode(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['gender' => 'male']);
        $directBoundModel = app(User::class)->forceFill(['gender' => 'female']);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'bind' => $directBoundModel,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_checked_status_from_component_bound_int_in_group_mode(): void
    {
        // Should work with string against int
        $bind = app(User::class)->forceFill(['gender' => '1']);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="1" checked="checked"', $html);
    }
}
