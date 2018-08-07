<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Traits;

use PHPUnit\Framework\MockObject\Matcher\Invocation;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Trait PortToMock
 * @package Ekvedaras\LaravelTestHelpers\Traits
 */
trait PortToMock
{
    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    abstract public function getMock(): PHPUnit_Framework_MockObject_MockObject;

    /**
     * @inheritdoc
     */
    public function expects(Invocation $matcher)
    {
        return $this->getMock()->expects($matcher);
    }

    /**
     * @inheritdoc
     */
    public function __phpunit_setOriginalObject($originalObject)
    {
        return $this->getMock()->__phpunit_setOriginalObject($originalObject);
    }

    /**
     * @inheritdoc
     */
    public function __phpunit_getInvocationMocker()
    {
        return $this->getMock()->__phpunit_getInvocationMocker();
    }

    /**
     * @inheritdoc
     */
    public function __phpunit_verify()
    {
        return $this->getMock()->__phpunit_verify();
    }

    /**
     * @inheritdoc
     */
    public function __phpunit_hasMatchers()
    {
        return $this->getMock()->__phpunit_hasMatchers();
    }

    /**
     * @param bool $returnValueGeneration
     * @return mixed
     */
    public function __phpunit_setReturnValueGeneration(bool $returnValueGeneration)
    {
        return $this->getMock()->__phpunit_setReturnValueGeneration($returnValueGeneration);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->getMock()->$name($arguments);
    }
}