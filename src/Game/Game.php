<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Contracts\Registries\Registry as RegistryContract;
use BinaryStudioAcademy\Game\Registries\Registry;
use Illuminate\Container\Container;

class Game
{
    private $gameWorld;
    private $container;

    public function __construct()
    {
        $this->container = Container::getInstance();
        $this->container->bind(RegistryContract::class, Registry::class);
        $this->gameWorld = $this->container->make(GameWorld::class);
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
