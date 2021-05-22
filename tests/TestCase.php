<?php

namespace Okipa\LaravelFormComponents\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Okipa\LaravelFormComponents\LaravelFormComponentsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [LaravelFormComponentsServiceProvider::class];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
