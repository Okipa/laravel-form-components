<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
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
}
