<?php

declare(strict_types=1);

namespace Tests\Unit\Traits;

use Ekvedaras\LaravelTestHelpers\Traits\Helpers\BuildsMocks;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\ChecksSingletons;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\TestsCommands;
use Ekvedaras\LaravelTestHelpers\Traits\TestHelpers;
use Tests\TestCase;

/**
 * Class TestHelpersTest
 * @package Tests\Unit\Traits
 */
class TestHelpersTest extends TestCase
{
    /** @test */
    public function it_imports_traits(): void
    {
        $traits = class_uses(TestHelpers::class);

        $this->assertContains(BuildsMocks::class, $traits);
        $this->assertContains(ChecksSingletons::class, $traits);
        $this->assertContains(TestsCommands::class, $traits);
    }
}
