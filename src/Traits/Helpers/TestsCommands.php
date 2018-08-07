<?php

declare(strict_types=1);

namespace Ekvedaras\LaravelTestHelpers\Helpers;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Trait TestsCommands
 * @package Ekvedaras\LaravelTestHelpers\Helpers
 *
 * @property-read Application $app
 */
trait TestsCommands
{
    /**
     * @param string $commandClass
     * @return CommandTester
     */
    protected function getCommandTester(string $commandClass): CommandTester
    {
        /** @var Command $command */
        $command = $this->app->make($commandClass);
        $command->setLaravel($this->app);

        return new CommandTester($command);
    }
}