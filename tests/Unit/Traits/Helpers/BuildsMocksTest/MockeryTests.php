<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers\BuildsMocksTest;

use Mockery\MockInterface;
use Tests\Unit\Traits\Helpers\Dummy;
use Tests\Unit\Traits\Helpers\Injector;
use Illuminate\Contracts\Foundation\Application;

/**
 * Trait MockeryTests.
 * @property-read Application app
 * @method MockInterface mockery(string $mockClass, string $injectorClass = null, bool $onlyForInjector = false)
 */
trait MockeryTests
{
    /** @test */
    public function it_builds_mockery_mock(): void
    {
        $this->app->singleton(Dummy::class);
        $this->app->singleton(Injector::class);

        $previousInstance = app(Dummy::class);
        $previousInjector = app(Injector::class);

        $this->assertSame($previousInstance, app(Dummy::class));
        $this->assertSame($previousInjector, app(Injector::class));

        $mock = $this->mockery(Dummy::class);
        $this->assertInstanceOf(MockInterface::class, $mock);
        $this->assertSame($previousInjector, app(Injector::class), 'Injector should not be forgotten');

        $mock->shouldReceive('getFalse')->andReturnTrue();
        $this->assertTrue($mock->getFalse());

        $this->assertNotSame($previousInstance, app(Dummy::class));
        $this->assertSame($mock, app(Dummy::class));
    }

    /** @test */
    public function it_forgets_injector_instance_as_well_when_building_mockery_mock(): void
    {
        $this->app->singleton(Dummy::class);
        $this->app->singleton(Injector::class);
        $previousInstance = app(Dummy::class);
        $previousInjector = app(Injector::class);

        $this->assertSame($previousInstance, app(Dummy::class));
        $this->assertSame($previousInjector, app(Injector::class));

        $mock = $this->mockery(Dummy::class, Injector::class);
        $this->assertInstanceOf(MockInterface::class, $mock);

        $this->assertNotSame($previousInstance, app(Dummy::class));
        $this->assertNotSame($previousInjector, app(Injector::class));

        $this->assertSame($mock, app(Dummy::class));
        $this->assertSame($mock, app(Injector::class)->dummy);
    }

    /** @test */
    public function it_forgets_injector_instance_and_injects_mockery_mock_only_for_it(): void
    {
        $this->app->singleton(Dummy::class);
        $this->app->singleton(Injector::class);
        $previousInstance = app(Dummy::class);
        $previousInjector = app(Injector::class);

        $this->assertSame($previousInstance, app(Dummy::class));
        $this->assertSame($previousInjector, app(Injector::class));

        $mock = $this->mockery(Dummy::class, Injector::class, true);
        $this->assertInstanceOf(MockInterface::class, $mock);

        $this->assertNotSame($previousInstance, app(Dummy::class));
        $this->assertNotSame($previousInjector, app(Injector::class));

        $this->assertNotSame($mock, app(Dummy::class));
        $this->assertSame($mock, app(Injector::class)->dummy);
    }
}
