<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\ChecksSingletons;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\TestsCommands;

/**
 * Trait TestingHelpers
 * @package Ekvedaras\LaravelTestHelpers\Traits
 */
trait TestHelpers
{
    use BuildsMocks,
        ChecksSingletons,
        TestsCommands;
}