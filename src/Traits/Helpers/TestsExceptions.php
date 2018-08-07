<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits\Helpers;

/**
 * Trait TestsExceptions
 * @package Ekvedaras\LaravelTestHelpers\Helpers
 *
 * @method void fail($reason)
 */
trait TestsExceptions
{
    /**
     * Fails if this method call is executed
     */
    protected function assertNotReached(): void
    {
        $this->fail('This should never reach!');
    }
}