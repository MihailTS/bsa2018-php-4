<?php

namespace BinaryStudioAcademy\Game\Factories;

use BinaryStudioAcademy\Game\Commands;
use BinaryStudioAcademy\Game\Contracts\Commands\Command;
use BinaryStudioAcademy\Game\Contracts\Factories\CommandFactory as CommandFactoryContract;
use BinaryStudioAcademy\Game\GameWorld;

class CommandFactory implements CommandFactoryContract
{
    protected $gameWorld;
    protected $commandRegistry;
    protected $resourceRegistry;
    protected $spaceshipModulesRegistry;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->commandRegistry = $gameWorld->commandRegistry;
        $this->resourceRegistry = $gameWorld->resourceRegistry;
        $this->spaceshipModulesRegistry = $gameWorld->spaceshipModulesRegistry;
    }

    public function create($type): ?Command
    {
        switch ($type) {
            case 'mine':
                $command = new Commands\MineResourceCommand($this->gameWorld);
                break;
            case 'produce':
                $command = new Commands\ProduceResourceCommand($this->gameWorld);
                break;
            case 'build':
                $command = new Commands\BuildSpaceshipModuleCommand($this->gameWorld);
                break;
            case 'scheme':
                $command = new Commands\SchemeOfSpaceshipModuleCommand($this->gameWorld);
                break;
            case 'help':
                $command = new Commands\HelpCommand();
                break;
            case 'status':
                $command = new Commands\StatusCommand($this->gameWorld);
                break;
            case 'exit':
                $command = new Commands\ExitGameCommand($this->gameWorld);
                break;
            default:
                return null;
        }
        $this->commandRegistry->set($type, $command);

        return $command;
    }
}
