<?php

declare(strict_types=1);

namespace Tests;

use Exception;
use Carbon\Carbon;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
class TestCase extends BaseTestCase
{
    /**
     * Set carbon date to avoid test timing issues.
     * @throws Exception
     */
    protected function setUp()
    {
        parent::setUp();

        Carbon::setTestNow(now());
    }
}
