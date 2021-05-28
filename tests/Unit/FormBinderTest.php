<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class FormBinderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_bind_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindModel($user);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_bind_multiple_models(): void
    {
        $user1 = app(User::class)->forceFill(['first_name' => 'Test first name 1']);
        $user2 = app(User::class)->forceFill(['first_name' => 'Test first name 2']);
        app(FormBinder::class)->bindModel($user1);
        app(FormBinder::class)->bindModel($user2);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name 2"', $html);
        app(FormBinder::class)->unbindLastModel();
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name 1"', $html);
    }

    /** @test */
    public function it_can_override_model_binding(): void
    {
        $user1 = app(User::class)->forceFill(['first_name' => 'Test first name 1']);
        $user2 = app(User::class)->forceFill(['first_name' => 'Test first name 2']);
        app(FormBinder::class)->bindModel($user1);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'model' => $user2]);
        self::assertStringContainsString(' value="Test first name 2"', $html);
    }
}
