<?php

namespace BinaryStudioAcademy\Game\Contracts;


use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;

interface GameWorld
{
    public function executeNextCommand(Reader $reader, Writer $writer);

    public function isVictory(): bool;

    public function isRunning(): bool;

    public function exit();

    public function getSpaceshipModulesRegistry();

    public function getCommandsRegistry();

    public function getResourceRegistry();
}