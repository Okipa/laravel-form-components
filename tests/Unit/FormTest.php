<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Okipa\LaravelFormComponents\Components\Form;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class FormTest extends TestCase
{
    /** @test */
    public function it_can_setup_get_method_by_default(): void
    {
        $html = $this->renderComponent(Form::class);
        self::assertStringContainsString('<form method="GET"', $html);
    }

    /** @test */
    public function it_can_set_non_spoofing_head_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'HEAD']);
        self::assertStringContainsString('<form method="HEAD"', $html);
        self::assertStringNotContainsString('<input type="hidden" name="_token"', $html);
    }

    /** @test */
    public function it_can_set_non_spoofing_get_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'GET']);
        self::assertStringContainsString('<form method="GET"', $html);
        self::assertStringNotContainsString('<input type="hidden" name="_token"', $html);
    }

    /** @test */
    public function it_can_set_non_spoofing_options_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'OPTIONS']);
        self::assertStringContainsString('<form method="OPTIONS"', $html);
        self::assertStringNotContainsString('<input type="hidden" name="_token"', $html);
    }

    /** @test */
    public function it_can_set_non_spoofing_post_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'POST']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
    }

    /** @test */
    public function it_can_set_spoofing_put_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'PUT']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
        self::assertStringContainsString('<input type="hidden" name="_method" value="PUT">', $html);
    }

    /** @test */
    public function it_can_set_spoofing_patch_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'PATCH']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
        self::assertStringContainsString('<input type="hidden" name="_method" value="PATCH">', $html);
    }

    /** @test */
    public function it_can_set_spoofing_delete_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'DELETE']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
        self::assertStringContainsString('<input type="hidden" name="_method" value="DELETE">', $html);
    }

    /** @test */
    public function it_can_bind_data_batch_from_form(): void
    {
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindNewDataBatch')->once()->with(['test']);
        $formBinder->shouldReceive('unbindLastDataBatch')->once();
        $this->renderComponent(Form::class, ['bind' => ['test']]);
    }

    /** @test */
    public function it_can_bind_error_bag_from_form(): void
    {
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindErrorBag')->once()->with('error_bag_test');
        $formBinder->shouldReceive('unbindErrorBag')->once();
        $this->renderComponent(Form::class, ['errorBag' => 'error_bag_test']);
    }

    /** @test */
    public function it_can_bind_livewire_modifier_from_form(): void
    {
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindNewLivewireModifier')->once()->with('debounce.150ms');
        $formBinder->shouldReceive('unbindLastLivewireModifier')->once();
        $this->renderComponent(Form::class, ['wire' => 'debounce.150ms']);
    }

    /** @test */
    public function it_can_bind_empty_livewire_modifier_from_form(): void
    {
        $formBinder = $this->mock(FormBinder::class);
        $formBinder->shouldReceive('bindNewLivewireModifier')->once()->with(null);
        $formBinder->shouldReceive('unbindLastLivewireModifier')->once();
        $this->renderComponent(Form::class, ['wire' => true]);
    }
}
