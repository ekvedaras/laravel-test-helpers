<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Tests\TestCase;

/**
 * Class BuildsMocksTest
 * @package Tests\Unit\Traits\Helpers
 */
class BuildsMocksTest extends TestCase
{
    use BuildsMocks;

    /** @test */
    public function it_creates_helper_class_which_extends_the_mock(): void
    {
        $mock = $this->mock(Dummy::class);

        $this->assertInstanceOf(Dummy::class, $mock->getMock());
    }

    /** @test */
    public function it_injects_mock_into_laravel(): void
    {
        $mock = $this->mock(Dummy::class);

        $this->assertSame($mock, app(Dummy::class));
    }

    /** @test */
    public function it_forgets_given_class_before_creating_a_mock(): void
    {
        $this->app->singleton(Dummy::class);
        $previousInstance = app(Dummy::class);

        $this->assertSame($previousInstance, app(Injector::class)->dummy);

        $mock = $this->mock(Dummy::class);

        $this->assertNotSame($previousInstance, app(Injector::class)->dummy);
        $this->assertSame($mock, app(Injector::class)->dummy);
    }
}


/**
 * Class Dummy
 * @package Tests\Unit\Traits\Helpers
 */
class Dummy
{
    /**
     * @param null $foo
     * @param null $bar
     * @return bool
     */
    public function getFalse($foo = null, $bar = null): bool
    {
        return false;
    }
}

/**
 * Class Injector
 * @package Tests\Unit\Traits\Helpers
 */
class Injector
{
    /** @var Dummy */
    public $dummy;

    /**
     * Injector constructor.
     * @param Dummy $dummy
     */
    public function __construct(Dummy $dummy)
    {
        $this->dummy = $dummy;
    }
}