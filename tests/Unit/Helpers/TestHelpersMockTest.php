<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers;

use Ekvedaras\LaravelTestHelpers\Helpers\TestHelpersMock;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Exception;
use Tests\TestCase;

/**
 * Class TestHelpersMockTest
 * @package Tests\Unit\Helpers
 * @covers \Ekvedaras\LaravelTestHelpers\Helpers\TestHelpersMock
 * @runTestsInSeparateProcesses
 */
class TestHelpersMockTest extends TestCase
{
    use BuildsMocks;

    /** @test */
    public function it_sets_once_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->once('getFalse')->willReturn(true);

        $this->assertTrue($mock->getFalse());
    }

    /** @test */
    public function it_sets_once_expectation_with_arguments(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->once('getFalse', $foo = str_random(), $bar = str_random())->willReturn(true);

        $this->assertTrue($mock->getFalse($foo, $bar));
    }

    /** @test */
    public function it_sets_twice_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->twice('getFalse')->willReturn(true);

        $this->assertTrue($mock->getFalse());
        $this->assertTrue($mock->getFalse());
    }

    /** @test */
    public function it_sets_twice_expectation_with_arguments(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->twice('getFalse', $foo = str_random(), $bar = str_random())->willReturn(true);

        $this->assertTrue($mock->getFalse($foo, $bar));
        $this->assertTrue($mock->getFalse($foo, $bar));
    }

    /** @test */
    public function it_sets_times_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->times($times = rand(1, 5), 'getFalse')->willReturn(true);

        for ($time = 0; $time < $times; $time++) {
            $this->assertTrue($mock->getFalse());
        }
    }

    /** @test */
    public function it_sets_times_expectation_with_arguments(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->times($times = rand(1, 5), 'getFalse', $foo = str_random(), $bar = str_random())->willReturn(true);

        for ($time = 0; $time < $times; $time++) {
            $this->assertTrue($mock->getFalse($foo, $bar));
        }
    }

    /** @test */
    public function it_sets_any_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->any('getFalse')->willReturn(true);

        for ($time = 0; $time < rand(1, 5); $time++) {
            $this->assertTrue($mock->getFalse());
        }
    }

    /** @test */
    public function it_sets_any_expectation_with_arguments(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->any('getFalse', $foo = str_random(), $bar = str_random())->willReturn(true);

        for ($time = 0; $time < rand(1, 5); $time++) {
            $this->assertTrue($mock->getFalse($foo, $bar));
        }
    }

    /** @test */
    public function it_sets_consecutive_twice_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->consecutiveTwice('getFalse')->willReturnOnConsecutiveCalls($return = (bool)rand(0, 1), !$return);

        $this->assertEquals($return, $mock->getFalse());
        $this->assertEquals(!$return, $mock->getFalse());
    }

    /** @test */
    public function it_sets_consecutive_twice_expectation_with_arguments(): void
    {
        $foo = str_random();
        $bar = str_random();

        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->consecutiveTwice('getFalse', [$foo, $bar], [$bar, $foo])
            ->willReturnOnConsecutiveCalls($return = (bool)rand(0, 1), !$return);

        $this->assertEquals($return, $mock->getFalse($foo, $bar));
        $this->assertEquals(!$return, $mock->getFalse($bar, $foo));
    }

    /** @test */
    public function it_sets_consecutive_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->consecutive(3, 'getFalse')
            ->willReturnOnConsecutiveCalls($return = (bool)rand(0, 1), !$return, $return);

        $this->assertEquals($return, $mock->getFalse());
        $this->assertEquals(!$return, $mock->getFalse());
        $this->assertEquals($return, $mock->getFalse());
    }

    /** @test */
    public function it_sets_consecutive_expectation_with_arguments(): void
    {
        $foo = str_random();
        $bar = str_random();

        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);
        $mock->consecutive(3, 'getFalse', [$foo, $bar], [$bar, $foo], [$foo, $foo])
            ->willReturnOnConsecutiveCalls($return = (bool)rand(0, 1), !$return, $return);

        $this->assertEquals($return, $mock->getFalse($foo, $bar));
        $this->assertEquals(!$return, $mock->getFalse($bar, $foo));
        $this->assertEquals($return, $mock->getFalse($foo, $foo));
    }

    /** @test */
    public function it_sets_never_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);

        $mock->never('getFalse');
    }

    /** @test */
    public function it_sets_fail_expectation(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);

        $mock->fail('getFalse', $exception = new Exception(str_random()));

        $this->expectExceptionObject($exception);

        $mock->getFalse();
    }

    /** @test */
    public function it_sets_fail_expectation_with_arguments(): void
    {
        /** @var TestHelpersMock|Dummy $mock */
        $mock = $this->mock(Dummy::class);

        $mock->fail('getFalse', $exception = new Exception(str_random()), $foo = str_random(), $bar = str_random());

        $this->expectExceptionObject($exception);

        $mock->getFalse($foo, $bar);
    }
}


/**
 * Class Dummy
 * @package Tests\Unit\Helpers
 */
class Dummy
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
 * @package Tests\Unit\Helpers
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