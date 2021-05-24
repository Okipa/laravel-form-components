<?php

namespace Okipa\LaravelFormComponents\Tests;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\LaravelFormComponentsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [LaravelFormComponentsServiceProvider::class];
    }

    protected function executeWebMiddlewareGroup(): void
    {
        $this->app['router']->get('test', ['middleware' => 'web']);
        $this->call('GET', 'test');
    }

    protected function renderComponent(array $data): string
    {
        $input = app(Input::class, $data);

        return $input->render()->with($input->data())->render();
    }
}
