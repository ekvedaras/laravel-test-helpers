<?php

declare(strict_types=1);

namespace Tests;

use Carbon\Carbon;
use Exception;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 */
class TestCase extends BaseTestCase
{
    /**
     * Set carbon date to avoid test timing issues
     * @throws Exception
     */
    protected function setUp()
    {
        parent::setUp();

        Carbon::setTestNow(now());
    }
}