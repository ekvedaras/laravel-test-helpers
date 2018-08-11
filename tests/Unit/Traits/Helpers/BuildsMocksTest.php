<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Tests\TestCase;
use Tests\Unit\Traits\Helpers\BuildsMocksTest\MockeryTests;
use Tests\Unit\Traits\Helpers\BuildsMocksTest\PhpunitTests;
use Tests\Unit\Traits\Helpers\BuildsMocksTest\SpyTests;

/**
 * Class BuildsMocksTest
 * @package Tests\Unit\Traits\Helpers
 */
class BuildsMocksTest extends TestCase
{
    use BuildsMocks, PhpunitTests, MockeryTests, SpyTests;
}

/**
 * Class Dummy
 * @package Tests\Unit\Traits\Helpers
 */
class Dummy
{
    /** @var bool */
    private $foo;

    /**
     * Dummy constructor.
     * @param bool $foo
     */
    public function __construct(bool $foo = false)
    {
        $this->foo = $foo;
    }

    /**
     * @param null $foo
     * @param null $bar
     * @return bool
     */
    public function getFalse($foo = null, $bar = null): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getFoo(): bool
    {
        return (bool)$this->foo;
    }
}

/**
 * Class DummyNoConstructor
 * @package Tests\Unit\Traits\Helpers
 */
class DummyNoConstructor
{
    /**
     * @param null $foo
     * @param null $bar
     * @return bool
     */
    public function getFalse($foo = null, $bar = null): bool
    {
        return false;
    }
}

/**
 * Class Injector
 * @package Tests\Unit\Traits\Helpers
 */
class Injector
{
    /** @var Dummy */
    public $dummy;

    /**
     * Injector constructor.
     * @param Dummy $dummy
     */
    public function __construct(Dummy $dummy)
    {
        $this->dummy = $dummy;
    }
}