<?php

namespace Okipa\LaravelFormComponents\Tests;

use Illuminate\Support\Facades\Config;

class Bootstrap5TestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Config::set('form-components.ui', 'bootstrap-5');
    }
}
