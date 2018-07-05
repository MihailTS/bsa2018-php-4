<?php

namespace BinaryStudioAcademy\Game\Contracts\SpaceshipModules;


interface SpaceshipModulePart
{
    public static function getName(): string;

    public function isAvailable(): bool;

    public function useToBuild();
}
