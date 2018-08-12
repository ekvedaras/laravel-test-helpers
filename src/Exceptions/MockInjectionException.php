<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Exceptions;

use Exception;

/**
 * Class MockInjectionException.
 */
class MockInjectionException extends Exception
{
    /**
     * @return static
     */
    public static function injectorNotGiven(): self
    {
        return new static('Injector class must be specified when using "onlyForInjector"');
    }
}
