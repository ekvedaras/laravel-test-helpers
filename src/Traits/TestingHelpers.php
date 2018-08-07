<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\ChecksSingletons;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\TestsCommands;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\TestsExceptions;

/**
 * Trait TestingHelpers
 * @package Ekvedaras\LaravelTestHelpers\Traits
 */
trait TestingHelpers
{
    use BuildsMocks,
        ChecksSingletons,
        TestsCommands,
        TestsExceptions;
}