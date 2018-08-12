<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits\Helpers;

use Illuminate\Foundation\Application;

/**
 * Trait ChecksSingletons.
 *
 * @property-read Application $app
 * @method void assertSame($expected, $actual, $message = '')
 */
trait ChecksSingletons
{
    /**
     * @param string $class
     */
    protected function assertSingleton(string $class): void
    {
        $this->assertSame(
            $this->app->make($class),
            $this->app->make($class),
            $class.' must be registered as singleton'
        );
    }
}
