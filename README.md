# laravel-test-helpers
Various helpers for writing tests for Laravel applications

## Installation

`composer require ekvedaras/laravel-test-helpers --dev`

No to register any service providers.

## Helpers

### [`TestHelpersMock`](src/Helpers/TestHelpersMock.php)

Providers helper methods for defining PhpUnit mock expectations more quickly.

* `once`
* `twice`
* `times`
* `any`
* `consecutiveTwice`
* `consecutive`
* `never`
* `fail`

> NOTE: To create this mock `BuildsMocks@mock` has to be used

### [`BuildsMocks`](src/Traits/BuildsMocks.php) trait

`TODO`

### [`ChecksSingletons`](src/Traits/ChecksSingletons.php) trait

`TODO`

### [`TestsCommands`](src/Traits/TestsCommands.php) trait

`TODO`

### [`TestsExceptions`](src/Traits/TestsExceptions.php) trait

`TODO`

## Examples

### Mock expectations with `TestHelpersMock`

```php
$mock = $this->mock('SomeClass');

// Default
// Using helpers
    
$mock->expects($this->once())->method('someMethod');
$mock->once('someMethod');
        
$mock->expects($this->once())->method('someMethod')->with($foo, $bar);
$mock->once('someMethod', $foo, $bar);

$mock->expects($this->exactly(2))->method('someMethod')->with($foo, $bar);
$mock->twice('someMethod', $foo, $bar);

$mock->expects($this->exactly(3))->method('someMethod')->with($foo, $bar)->willReturn(true);
$mock->times(3, 'someMethod', $foo, $bar)->willReturn(true);

$mock->expects($this->any())->method('someMethod')->with($foo, $bar);
$mock->any('someMethod', $foo, $bar);

$mock->expects($this->exactly(2))->method('someMethod')->withConsecutive([$foo], [$bar]);
$mock->consecutiveTwice('someMethod', [$foo], [$bar]);

$mock->expects($this->exactly(3)->method('someMethod')->withConsecutive([$foo], [$bar], [$foo, $bar]);
$mock->consecutive(3, 'someMethod', [$foo], [$bar], [$foo, $bar]);

$mock->expects($this->never())->method('someMethod');
$mock->never('someMethod');

$mock->expects($this->any())->method('someMethod')->willThrowException(new \Exception());
$mock->fail('someMethod', new \Exception());
        
$mock->expects($this->any())->method('someMethod')->with($foo, $bar)->willThrowException(new \Exception());
$mock->fail('someMethod', new \Exception(), $foo, $bar);
```

### Build mocks with `BuildsMocks`

```php
// TODO
```

### Assert singleton definition with `ChecksSingletons`

```php
// TODO
```

### Test console commands with `TestsCommands`

```php
// TODO
```