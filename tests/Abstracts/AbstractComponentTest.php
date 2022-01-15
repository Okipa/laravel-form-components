<?php

namespace Okipa\LaravelFormComponents\Tests\Abstracts;

use Okipa\LaravelFormComponents\Tests\TestCase;

abstract class AbstractComponentTest extends TestCase
{
    protected string $componentClass;

    protected function setUp(): void
    {
        parent::setUp();
        $this->componentClass = $this->setComponentClass();
        $this->executeWebMiddlewareGroup();
    }

    abstract protected function setComponentClass(): string;
}
