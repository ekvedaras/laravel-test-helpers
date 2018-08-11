<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\ChecksSingletons;
use Tests\TestCase;

/**
 * Class ChecksSingletonsTest
 * @package Tests\Unit\Traits\Helpers
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
 * Class DummySingleton
 * @package Tests\Unit\Traits\Helpers
 */
class DummySingleton
{
}
