<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class FormBinderTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_current_binded_model_when_several_are_bound(): void
    {
        $user1 = app(User::class)->forceFill(['first_name' => 'Test first name 1']);
        $user2 = app(User::class)->forceFill(['first_name' => 'Test first name 2']);
        app(FormBinder::class)->bindNewModel($user1);
        app(FormBinder::class)->bindNewModel($user2);
        self::assertSame($user2, app(FormBinder::class)->getBoundModel());
        app(FormBinder::class)->unbindLastModel();
        self::assertSame($user1, app(FormBinder::class)->getBoundModel());
    }
}
