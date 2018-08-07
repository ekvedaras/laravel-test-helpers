<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Helpers;

use Illuminate\Foundation\Application;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit_Framework_MockObject_MockObject;
use RuntimeException;

/**
 * Trait BuildsMocks
 * @package Ekvedaras\LaravelTestHelpers\Helpers
 *
 * @property-read Application $app
 * @method MockBuilder getMockBuilder(string $mockClass)
 */
trait BuildsMocks
{
    /**
     * @param string $mockClass
     * @param string|null $injectorClass
     * @param array|null|bool $methods
     * @param array|null $constructorArgs
     * @param bool $onlyForInjector
     * @return TestHelpersMock
     * @throws RuntimeException
     */
    protected function initPHPUnitMock(
        string $mockClass,
        string $injectorClass = null,
        $methods = false,
        array $constructorArgs = null,
        bool $onlyForInjector = false
    ): TestHelpersMock {
        $this->forgetInstances($mockClass, $injectorClass);
        $mock = $this->createPHPUnitMockBuilder($mockClass, $constructorArgs, $methods);
        $this->injectMockToLaravel($mockClass, $mock, $onlyForInjector, $injectorClass);

        return $mock;
    }

    /**
     * @param string $mockClass
     * @param string|null $injectorClass
     * @param bool $onlyForInjector
     * @return MockInterface
     */
    protected function initMockeryMock(
        string $mockClass,
        string $injectorClass = null,
        bool $onlyForInjector = false
    ): MockInterface {
        $this->forgetInstances($mockClass, $injectorClass);
        $mock = Mockery::mock($mockClass);
        $this->injectMockToLaravel($mockClass, $mock, $onlyForInjector, $injectorClass);

        return $mock;
    }

    /**
     * @param string $mockClass
     * @param string|null $injectorClass
     * @param bool $onlyForInjector
     * @return MockInterface
     */
    protected function initMockerySpy(
        string $mockClass,
        string $injectorClass = null,
        bool $onlyForInjector = false
    ): MockInterface {
        $this->forgetInstances($mockClass, $injectorClass);
        $mock = Mockery::spy($mockClass);
        $this->injectMockToLaravel($mockClass, $mock, $onlyForInjector, $injectorClass);

        return $mock;
    }

    /**
     * @param string $mockClass
     * @param string|null $injectorClass
     */
    private function forgetInstances(string $mockClass, string $injectorClass = null): void
    {
        $this->app->forgetInstance($mockClass);

        if (isset($injectorClass)) {
            $this->app->forgetInstance($injectorClass);
        }
    }

    /**
     * @param string $mockClass
     * @param array|null $constructorArgs
     * @param array|null|bool $methods
     * @return TestHelpersMock
     */
    private function createPHPUnitMockBuilder(
        string $mockClass,
        array $constructorArgs = null,
        $methods = false
    ): TestHelpersMock {
        $builder = $this->getMockBuilder($mockClass);

        if (isset($constructorArgs)) {
            $builder->setConstructorArgs($constructorArgs);
        } else {
            $builder->disableOriginalConstructor();
        }

        if ($methods !== false) {
            $builder->setMethods($methods);
        }

        return new TestHelpersMock($builder->getMock());
    }

    /**
     * @param string $mockClass
     * @param PHPUnit_Framework_MockObject_MockObject|MockInterface $mock
     * @param bool $onlyForInjector
     * @param string|null $injectorClass
     * @throws RuntimeException
     */
    private function injectMockToLaravel(
        string $mockClass,
        $mock,
        bool $onlyForInjector = false,
        string $injectorClass = null
    ): void {
        if ($onlyForInjector) {
            if (!isset($injectorClass)) {
                throw new RuntimeException('Injector class must be specified when using "onlyForInjector" bind.');
            }

            $this->app->when($injectorClass)->needs($mockClass)->give(function () use ($mock) {
                return $mock;
            });
        } else {
            $this->app->instance($mockClass, $mock);
        }
    }
}