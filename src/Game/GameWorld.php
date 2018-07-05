<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Contracts\Registries\Registry;
use BinaryStudioAcademy\Game\Factories\CommandFactory;
use BinaryStudioAcademy\Game\Factories\ModulesFactory;
use BinaryStudioAcademy\Game\Factories\ResourceFactory;

class GameWorld
{
    private $isRunning = true;

    private $resourceFactory;
    private $commandFactory;
    private $modulesFactory;

    public $resourceRegistry;
    public $commandRegistry;
    public $spaceshipModulesRegistry;

    public function __construct(Registry $resourceRegistry, Registry $commandRegistry, Registry $spaceshipModulesRegistry)
    {
        $this->resourceRegistry = $resourceRegistry;
        $this->commandRegistry = $commandRegistry;
        $this->spaceshipModulesRegistry = $spaceshipModulesRegistry;

        $this->initResources();
        $this->initCommands();
        $this->initSpaceshipModules();
    }

    private function initResources()
    {
        $this->resourceFactory = new ResourceFactory($this);

        $availableResourceNames = [
            'fire',
            'iron',
            'sand',
            'water',
            'fuel',
            'copper',
            'carbon',
            'silicon',
            'metal',
        ];
        foreach ($availableResourceNames as $resourceName) {
            $this->resourceFactory->create($resourceName);
        }

        return $this;
    }

    private function initCommands()
    {
        $this->commandFactory = new CommandFactory($this);

        $availableCommandsName = [
            'mine',
            'produce',
            'build',
            'scheme',
            'status',
            'help',
            'exit',
        ];
        foreach ($availableCommandsName as $commandName) {
            $this->commandFactory->create($commandName);
        }

        return $this;
    }

    private function initSpaceshipModules()
    {
        $this->modulesFactory = new ModulesFactory($this);

        $availableModulesNames = [
            'ic',
            'wires',
            'control_unit',
            'engine',
            'launcher',
            'porthole',
            'shell',
            'tank',
        ];
        foreach ($availableModulesNames as $moduleName) {
            $this->modulesFactory->create($moduleName);
        }
    }

    public function executeNextCommand(Reader $reader, Writer $writer)
    {
        $command = "";
        $param = "";
        $input = trim($reader->read());
        $inputCommandArgs = explode(':', $input);

        if (!empty($inputCommandArgs)) {
            $command = $inputCommandArgs[0];
            if (count($inputCommandArgs) > 1) {
                $param = $inputCommandArgs[1];
            }
        }

        $commandToExec = $this->commandRegistry->get($command);
        if ($commandToExec) {
            $commandResult = $commandToExec->execute($param);
            $writer->writeln(ucfirst($commandResult));
        } else {
            $writer->writeln("There is no command {$command}");
        }
    }

    public function isVictory(): bool
    {
        $isVictory = true;
        foreach ($this->spaceshipModulesRegistry as $module) {
            if (!$module->isBuilt()) {
                $isVictory = false;
                break;
            }
        }
        return $isVictory;
    }

    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    public function exit()
    {
        $this->isRunning = false;
    }
}
