# laravel-test-helpers

[![Latest Version](https://img.shields.io/github/release/ekvedaras/laravel-test-helpers.svg)](https://github.com/ekvedaras/laravel-test-helpers/releases)
[![Build Status](https://img.shields.io/travis/ekvedaras/laravel-test-helpers/master.svg)](https://travis-ci.org/ekvedaras/laravel-test-helpers)
[![Quality Score](https://img.shields.io/scrutinizer/g/ekvedaras/laravel-test-helpers.svg)](https://scrutinizer-ci.com/g/ekvedaras/laravel-test-helpers)
[![Coverage Status](https://coveralls.io/repos/github/ekvedaras/laravel-test-helpers/badge.svg)](https://coveralls.io/github/ekvedaras/laravel-test-helpers)
[![StyleCI](https://styleci.io/repos/143764475/shield?style=flat)](https://styleci.io/repos/143764475)
[![Total Downloads](https://img.shields.io/packagist/dt/ekvedaras/laravel-test-helpers.svg)](https://packagist.org/packages/ekvedaras/laravel-test-helpers)

When writing tests daily, some actions might get frustrating to repeat.
This package offers a solution to some of those problems and helps to write tests faster and make them more clean.
It does not enforce anything. The main way of building mocks and expectations can still be used where it makes sense to.

## Changelog

* [v1.*](./CHANGELOG-1.x.md)

## Installation

`composer require ekvedaras/laravel-test-helpers --dev`

## Usage

Just use `TestHelpers` trait (or any of others provided if you want to be explicit) in your test class.

## Helpers

### [`TestHelpersMock`](src/Helpers/TestHelpersMock.php)

Providers helper methods for defining PhpUnit mock expectations more quickly.

> NOTE: To create this mock `BuildsMocks@mock` has to be used

* `once`
* `twice`
* `times`
* `any`
* `consecutiveTwice`
* `consecutive`
* `never`
* `fail`

### [`BuildsMocks`](src/Traits/Helpers/BuildsMocks.php) trait

Creates mocks and injects them into Laravel, so mocks would be resolve instead of real instances
using `app(My::class)` and when container auto resolves injector(s) constructor arguments.

```php
// Creates PhpUnit mock wrapped with TestHelpersMock 
$this->mock($mockClass, $injectorClass, $methods, $constructorArgs, $onlyForInjector);

// Creates Mockery mock
$this->mockery($mockClass, $injectorClass, $onlyForInjector);

// Creates spy mock
$this->spy($mockClass, $injectorClass, $onlyForInjector);
```

> NOTE: Only the first parameter is required

### [`ChecksSingletons`](src/Traits/Helpers/ChecksSingletons.php) trait

Checks if given class is marked as a singleton.

```php
$this->assertSingleton(My::class);
```

### [`TestsCommands`](src/Traits/Helpers/TestsCommands.php) trait

Creates command tester for a given command class.

```php
$tester = $this->getCommandTester(MyCommand::class);
$tester->execute($input);
$out = $tester->getDisplay();
```

### [`TestsHelpers`](src/Traits/TestHelpers.php) trait

Just a convenient trait which includes all traits mentioned above.

## Examples

> More examples can be found in [packages tests](tests/Unit).

### Mock expectations with `TestHelpersMock`

```php
use BuildsMocks;

$mock = $this->mock(My::class);


// Using helpers
// Equivalent


$mock->once('someMethod');
$mock->expects($this->once())->method('someMethod');

$mock->once('someMethod', $foo, $bar);        
$mock->expects($this->once())->method('someMethod')->with($foo, $bar);

$mock->twice('someMethod', $foo, $bar);
$mock->expects($this->exactly(2))->method('someMethod')->with($foo, $bar);

$mock->times(3, 'someMethod', $foo, $bar)->willReturn(true);
$mock->expects($this->exactly(3))->method('someMethod')->with($foo, $bar)->willReturn(true);

$mock->any('someMethod', $foo, $bar);
$mock->expects($this->any())->method('someMethod')->with($foo, $bar);

$mock->consecutiveTwice('someMethod', [$foo], [$bar]);
$mock->expects($this->exactly(2))->method('someMethod')->withConsecutive([$foo], [$bar]);

$mock->consecutive(3, 'someMethod', [$foo], [$bar], [$foo, $bar]);
$mock->expects($this->exactly(3)->method('someMethod')->withConsecutive([$foo], [$bar], [$foo, $bar]);

$mock->never('someMethod');
$mock->expects($this->never())->method('someMethod');

$mock->fail('someMethod', new \Exception());
$mock->expects($this->any())->method('someMethod')->willThrowException(new \Exception());

$mock->fail('someMethod', new \Exception(), $foo, $bar);
$mock->expects($this->any())->method('someMethod')->with($foo, $bar)->willThrowException(new \Exception());
```
