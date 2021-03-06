<?php

declare(strict_types=1);

namespace Tests\Unit\Traits\Helpers;

use Tests\TestCase;
use Illuminate\Console\Command;
use Ekvedaras\LaravelTestHelpers\Traits\Helpers\TestsCommands;

/**
 * Class TestsCommandsTest.
 */
class TestsCommandsTest extends TestCase
{
    use TestsCommands;

    /** @test */
    public function it_creates_command_tester(): void
    {
        $tester = $this->getCommandTester(DummyCommand::class);

        $this->assertEquals(0, $tester->execute(['arg1' => $arg1 = str_random()]));

        $output = $tester->getDisplay(true);

        $this->assertContains('Laravel was set', $output);
        $this->assertContains('First argument is '.$arg1, $output);
    }
}

/**
 * Class DummyCommand.
 */
class DummyCommand extends Command
{
    /** @var string */
    protected $signature = 'dummy {arg1}';

    public function handle()
    {
        if ($this->getLaravel()) {
            $this->info('Laravel was set');
        }

        $this->info('First argument is '.$this->argument('arg1'));
    }
}
