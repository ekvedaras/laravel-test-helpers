<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers\BuildsMocksTest;

use Illuminate\Contracts\Foundation\Application;
use Mockery\MockInterface;
use Tests\Unit\Traits\Helpers\Dummy;
use Tests\Unit\Traits\Helpers\Injector;

/**
 * Trait SpyTests
 * @package Tests\Unit\Traits\Helpers\BuildsMocksTest
 * @property-read Application app
 * @method MockInterface spy(string $mockClass, string $injectorClass = null, bool $onlyForInjector = false)
 */
trait SpyTests
{
    /** @test */
    public function it_builds_mockery_spy_mock(): void
    {
        $this->app->singleton(Dummy::class);
        $this->app->singleton(Injector::class);

        $previousInstance = app(Dummy::class);
        $previousInjector = app(Injector::class);

        $this->assertSame($previousInstance, app(Dummy::class));
        $this->assertSame($previousInjector, app(Injector::class));

        $mock = $this->spy(Dummy::class);
        $this->assertInstanceOf(MockInterface::class, $mock);

        $this->assertSame($previousInjector, app(Injector::class), 'Injector should not be forgotten');

        $mock->shouldReceive('getFalse')->andReturnTrue();
        $this->assertTrue($mock->getFalse());

        $this->assertNotSame($previousInstance, app(Dummy::class));
        $this->assertSame($mock, app(Dummy::class));
    }

    /** @test */
    public function it_forgets_injector_instance_as_well_when_building_mockery_spy_mock(): void
    {
        $this->app->singleton(Dummy::class);
        $this->app->singleton(Injector::class);
        $previousInstance = app(Dummy::class);
        $previousInjector = app(Injector::class);

        $this->assertSame($previousInstance, app(Dummy::class));
        $this->assertSame($previousInjector, app(Injector::class));

        $mock = $this->spy(Dummy::class, Injector::class);
        $this->assertInstanceOf(MockInterface::class, $mock);

        $this->assertNotSame($previousInstance, app(Dummy::class));
        $this->assertNotSame($previousInjector, app(Injector::class));

        $this->assertSame($mock, app(Dummy::class));
        $this->assertSame($mock, app(Injector::class)->dummy);
    }

    /** @test */
    public function it_forgets_injector_instance_and_injects_mockery_spy_mock_only_for_it(): void
    {
        $this->app->singleton(Dummy::class);
        $this->app->singleton(Injector::class);
        $previousInstance = app(Dummy::class);
        $previousInjector = app(Injector::class);

        $this->assertSame($previousInstance, app(Dummy::class));
        $this->assertSame($previousInjector, app(Injector::class));

        $mock = $this->spy(Dummy::class, Injector::class, true);
        $this->assertInstanceOf(MockInterface::class, $mock);

        $this->assertNotSame($previousInstance, app(Dummy::class));
        $this->assertNotSame($previousInjector, app(Injector::class));

        $this->assertNotSame($mock, app(Dummy::class));
        $this->assertSame($mock, app(Injector::class)->dummy);
    }
}