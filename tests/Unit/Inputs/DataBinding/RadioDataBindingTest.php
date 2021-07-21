<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBindings;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioDataBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_radio_checked_status_from_direct_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['gender' => 'female']);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_direct_bound_array(): void
    {
        $bind = ['gender' => 'female'];
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_direct_bound_collection(): void
    {
        $bind = collect(['gender' => 'female']);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_direct_bound_object(): void
    {
        $bind = (object) ['gender' => 'female'];
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
            'bind' => $bind,
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['gender' => 'female']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_global_bound_array(): void
    {
        $bind = ['gender' => 'female'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_global_bound_collection(): void
    {
        $bind = collect(['gender' => 'female']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_value_from_global_bound_object(): void
    {
        $bind = (object) ['gender' => 'female'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_global_radio_binding_by_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['gender' => 'male']);
        $directBoundModel = app(User::class)->forceFill(['gender' => 'female']);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
            'bind' => $directBoundModel
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_checked_status_from_int(): void
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
