<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\TestsCommands;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\ChecksSingletons;

/**
 * Trait TestingHelpers.
 */
trait TestHelpers
{
    use BuildsMocks,
        ChecksSingletons,
        TestsCommands;
}
