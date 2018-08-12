<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Helpers;

/**
 * Class TestHelpersMock.
 * @method PHPUnit\Framework\MockObject\Builder\InvocationMocker method($constraint)
 */
class TestHelpersMock implements \PHPUnit_Framework_MockObject_MockObject
{
    use \Ekvedaras\LaravelTestHelpers\Traits\PortToMock;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $mock;

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMock(): \PHPUnit_Framework_MockObject_MockObject
    {
        return $this->mock;
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function once(string $method, ...$vars): \PHPUnit\Framework\MockObject\Builder\InvocationMocker
    {
        return $this->times(1, $method, ...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function twice(string $method, ...$vars): \PHPUnit\Framework\MockObject\Builder\InvocationMocker
    {
        return $this->times(2, $method, ...$vars);
    }

    /**
     * @param int $times
     * @param string $method
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function times(int $times, string $method, ...$vars): \PHPUnit\Framework\MockObject\Builder\InvocationMocker
    {
        return $this->getMock()
            ->expects(\PHPUnit\Framework\TestCase::exactly($times))
            ->method($method)
            ->with(...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function any(string $method, ...$vars): \PHPUnit\Framework\MockObject\Builder\InvocationMocker
    {
        return $this->getMock()
            ->expects(\PHPUnit\Framework\TestCase::any())
            ->method($method)
            ->with(...$vars);
    }

    /**
     * @param string $method
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function consecutiveTwice(string $method, ...$vars): \PHPUnit\Framework\MockObject\Builder\InvocationMocker
    {
        return $this->consecutive(2, $method, ...$vars);
    }

    /**
     * @param int $times
     * @param string $method
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function consecutive(
        int $times,
        string $method,
        ...$vars
    ): \PHPUnit\Framework\MockObject\Builder\InvocationMocker {
        return $this->getMock()
            ->expects(\PHPUnit\Framework\TestCase::exactly($times))
            ->method($method)
            ->withConsecutive(...$vars);
    }

    /**
     * @param string $method
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function never(string $method): \PHPUnit\Framework\MockObject\Builder\InvocationMocker
    {
        return $this->getMock()->expects(\PHPUnit\Framework\TestCase::never())->method($method);
    }

    /**
     * @param string $method
     * @param \Exception $exception
     * @param mixed ...$vars
     * @return \PHPUnit\Framework\MockObject\Builder\InvocationMocker
     */
    public function fail(
        string $method,
        \Exception $exception,
        ...$vars
    ): \PHPUnit\Framework\MockObject\Builder\InvocationMocker {
        return $this->any($method, ...$vars)->willThrowException($exception);
    }
}
