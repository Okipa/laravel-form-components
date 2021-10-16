<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBindings;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioDataBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_radio_checked_status_from_direct_bound_model(): void
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
    public function it_can_retrieve_radio_value_from_direct_bound_array(): void
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
    public function it_can_retrieve_radio_value_from_direct_bound_collection(): void
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
    public function it_can_retrieve_radio_value_from_direct_bound_object(): void
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
    public function it_can_retrieve_radio_value_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['gender' => 'female']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
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
            'group' => ['female' => 'Female', 'male' => 'Male'],
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
            'group' => ['female' => 'Female', 'male' => 'Male'],
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
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_radio_global_data_binding_from_direct_bound_data(): void
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

    /** @test */
    public function it_can_override_radio_global_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('gender', 'Global error test');
        $componentMessageBag = app(MessageBag::class)->add('gender', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('global_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('global_error_bag');
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => [1 => 'Male', 2 => 'Female'],
            'errorBag' => 'component_error_bag'
        ]);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
