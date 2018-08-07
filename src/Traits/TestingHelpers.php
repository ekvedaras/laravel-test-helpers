<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits;

use Ekvedaras\LaravelTestHelpers\Helpers\BuildsMocks;
use Ekvedaras\LaravelTestHelpers\Helpers\ChecksSingletons;
use Ekvedaras\LaravelTestHelpers\Helpers\TestsCommands;
use Ekvedaras\LaravelTestHelpers\Helpers\TestsExceptions;

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