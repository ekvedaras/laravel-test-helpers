<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers;

use Tests\TestCase;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\ChecksSingletons;

/**
 * Class ChecksSingletonsTest.
 */
class ChecksSingletonsTest extends TestCase
{
    use ChecksSingletons;

    /** @test */
    public function it_checks_if_given_class_is_marked_as_singleton(): void
    {
        $this->app->singleton(DummySingleton::class);
        $this->assertSingleton(DummySingleton::class);
    }
}

/**
 * Class DummySingleton.
 */
class DummySingleton
{
}
