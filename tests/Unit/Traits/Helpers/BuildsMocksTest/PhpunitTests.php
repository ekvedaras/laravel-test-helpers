<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers\BuildsMocksTest;

use Ekvedaras\LaravelTestHelpers\Exceptions\MockInjectionException;
use Ekvedaras\LaravelTestHelpers\Helpers\TestHelpersMock;
use Illuminate\Contracts\Foundation\Application;
use Tests\Unit\Traits\Helpers\Dummy;
use Tests\Unit\Traits\Helpers\DummyNoConstructor;
use Tests\Unit\Traits\Helpers\Injector;

/**
 * Trait PhpunitTests
 * @package Tests\Unit\Traits\Helpers\BuildsMocksTest
 * @property-read Application app
 * @method TestHelpersMock mock(string $mockClass, string $injectorClass = null, $methods = false, array $constructorArgs = null, bool $onlyForInjector = false)
 */
trait PhpunitTests
{
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
    public function it_forgets_mock_class_instance_before_creating_a_mock(): void
    {
        $this->app->singleton(Dummy::class);
        $previousInstance = app(Dummy::class);

        $this->assertSame($previousInstance, app(Injector::class)->dummy);

        $mock = $this->mock(Dummy::class);

        $this->assertNotSame($previousInstance, app(Injector::class)->dummy);
        $this->assertSame($mock, app(Injector::class)->dummy);
    }

    /** @test */
    public function it_forgets_injector_instance_before_creating_a_mock(): void
    {
        $this->app->singleton(Injector::class);
        $previousInstance = app(Injector::class);

        $this->assertSame($previousInstance, app(Injector::class));

        $mock = $this->mock(Dummy::class, Injector::class);

        $this->assertNotSame($previousInstance, app(Injector::class));
        $this->assertSame($mock, app(Injector::class)->dummy);
    }

    /** @test */
    public function it_sets_mock_methods(): void
    {
        $mock = $this->mock(Dummy::class, null, ['voidMethod']);

        $mock->expects($this->once())->method('voidMethod')->willReturn(true);

        $this->assertFalse($mock->getFalse());
        $this->assertTrue($mock->voidMethod());
    }

    /** @test */
    public function it_passes_constructor_arguments(): void
    {
        $mock = $this->mock(Dummy::class, null, null, ['foo' => true]);

        $this->assertTrue($mock->getFoo());
    }

    /** @test */
    public function it_creates_mock_for_a_class_without_a_constructor(): void
    {
        $mock = $this->mock(DummyNoConstructor::class, null, false, []);
        $this->assertFalse($mock->getFalse());

        $mock->once('getFalse')->willReturn(true);
        $this->assertTrue($mock->getFalse());
    }

    /** @test */
    public function it_injects_mock_only_for_given_injector(): void
    {
        $mock = $this->mock(Dummy::class, Injector::class, false, null, true);

        $this->assertNotSame($mock, app(Dummy::class));
        $this->assertSame($mock, app(Injector::class)->dummy);
    }

    /** @test */
    public function it_throws_an_exception_when_injector_not_given_and_injecting_for_it_only(): void
    {
        $this->expectExceptionObject(MockInjectionException::injectorNotGiven());

        $this->mock(Dummy::class, null, false, null, true);
    }
}