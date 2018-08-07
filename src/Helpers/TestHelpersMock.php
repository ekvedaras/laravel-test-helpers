<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Helpers;

use Ekvedaras\LaravelTestHelpers\Traits\PortToMock;
use Exception;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class TestHelpersMock
 * @package Ekvedaras\LaravelTestHelpers\Helpers
 * @method InvocationMocker method($constraint)
 */
class TestHelpersMock implements PHPUnit_Framework_MockObject_MockObject
{
    use PortToMock;

    /** @var PHPUnit_Framework_MockObject_MockObject */
    private $mock;

    /**
     * TestingHelpersMock constructor.
     * @param PHPUnit_Framework_MockObject_MockObject $mock
     */
    public function __construct(PHPUnit_Framework_MockObject_MockObject $mock)
    {
        $this->mock = $mock;
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function getMock(): PHPUnit_Framework_MockObject_MockObject
    {
        return $this->mock;
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function once(string $method, ...$vars): InvocationMocker
    {
        return $this->times(1, $method, ...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function twice(string $method, ...$vars): InvocationMocker
    {
        return $this->times(2, $method, ...$vars);
    }

    /**
     * @param int $times
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function times(int $times, string $method, ...$vars): InvocationMocker
    {
        return $this->getMock()
            ->expects(TestCase::exactly($times))
            ->method($method)
            ->with(...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function any(string $method, ...$vars): InvocationMocker
    {
        return $this->getMock()
            ->expects(TestCase::any())
            ->method($method)
            ->with(...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function consecutiveTwice(string $method, ...$vars): InvocationMocker
    {
        return $this->consecutive(2, $method, ...$vars);
    }

    /**
     * @param int $times
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function consecutive(int $times, string $method, ...$vars): InvocationMocker
    {
        return $this->getMock()
            ->expects(TestCase::exactly($times))
            ->method($method)
            ->withConsecutive(...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function never(string $method, ...$vars): InvocationMocker
    {
        return $this->getMock()->expects(TestCase::never())->method($method)->with(...$vars);
    }

    /**
     * @param string $method
     * @param Exception $exception
     * @param mixed ...$vars
     * @return InvocationMocker
     */
    public function fail(string $method, Exception $exception, ...$vars): InvocationMocker
    {
        return $this->any($method, ...$vars)->willThrowException($exception);
    }
}