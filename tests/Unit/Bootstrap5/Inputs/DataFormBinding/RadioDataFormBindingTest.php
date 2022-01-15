<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_radio_checked_status_from_form_bound_model_in_group_mode(): void
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
    public function it_can_retrieve_radio_checked_status_from_form_bound_array_in_group_mode(): void
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
    public function it_can_retrieve_radio_checked_status_from_form_bound_collection_in_group_mode(): void
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
    public function it_can_retrieve_radio_checked_status_from_form_bound_object_in_group_mode(): void
    {
        $bind = (object) ['gender' => 'female'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }
}
