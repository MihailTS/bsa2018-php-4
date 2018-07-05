<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Registries\Registry;

class Game
{
    private $gameWorld;

    public function __construct()
    {
        $resourceRegistry = new Registry;
        $commandRegistry = new Registry;
        $modulesRegistry = new Registry;
        $this->gameWorld = new GameWorld($resourceRegistry, $commandRegistry, $modulesRegistry);
    }

    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln("You have to build your own spaceship now!");
        $writer->writeln("Just sitting at the computer! How do you like that, Elon Musk?");
        while ($this->gameWorld->isRunning()) {
            $this->gameWorld->executeNextCommand($reader, $writer);
        }
    }

    public function run(Reader $reader, Writer $writer): void
    {
        $this->gameWorld->executeNextCommand($reader, $writer);
    }
}
