<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers;

use Tests\TestCase;
use Tests\Unit\Traits\Helpers\BuildsMocksTest\SpyTests;
use Tests\Unit\Traits\Helpers\BuildsMocksTest\MockeryTests;
use Tests\Unit\Traits\Helpers\BuildsMocksTest\PhpunitTests;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;

/**
 * Class BuildsMocksTest.
 */
class BuildsMocksTest extends TestCase
{
    use BuildsMocks, PhpunitTests, MockeryTests, SpyTests;
}

/**
 * Class Dummy.
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
        return (bool) $this->foo;
    }
}

/**
 * Class DummyNoConstructor.
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
 * Class Injector.
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
