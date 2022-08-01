<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class FormBinderTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_current_bound_data_when_several_are_bound(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name 1']);
        $data = ['Test'];
        app(FormBinder::class)->bindNewDataBatch($user);
        app(FormBinder::class)->bindNewDataBatch($data);
        self::assertSame($data, app(FormBinder::class)->getBoundDataBatch());
        app(FormBinder::class)->unbindLastDataBatch();
        self::assertSame($user, app(FormBinder::class)->getBoundDataBatch());
    }

    /** @test */
    public function it_can_bind_and_unbind_data_from_directive(): void
    {
        view()->addNamespace('laravel-form-components', 'tests/views');
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindNewDataBatch')->once()->with(['test']);
        $formBinder->shouldReceive('unbindLastDataBatch')->once();
        view('laravel-form-components::data-binding-directive')->toHtml();
    }

    /** @test */
    public function it_can_bind_and_unbind_error_bag_from_directive(): void
    {
        view()->addNamespace('laravel-form-components', 'tests/views');
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindErrorBag')->once()->with('error_bag_test');
        $formBinder->shouldReceive('unbindErrorBag')->once();
        view('laravel-form-components::error-bag-binding-directive')->toHtml();
    }

    /** @test */
    public function it_can_retrieve_current_bound_livewire_modifier_when_several_are_bound(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('lazy');
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        self::assertSame('debounce.150ms', app(FormBinder::class)->getBoundLivewireModifer());
        app(FormBinder::class)->unbindLastLivewireModifier();
        self::assertSame('lazy', app(FormBinder::class)->getBoundLivewireModifer());
    }

    /** @test */
    public function it_can_bind_and_unbind_livewire_modifier_from_directive(): void
    {
        view()->addNamespace('laravel-form-components', 'tests/views');
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindNewLivewireModifier')->once()->with('debounce.150ms');
        $formBinder->shouldReceive('unbindLastLivewireModifier')->once();
        view('laravel-form-components::livewire-modifier-binding-directive')->toHtml();
    }
}
