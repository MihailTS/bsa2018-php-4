<?php

namespace BinaryStudioAcademy\Game\Contracts\Factories;

use BinaryStudioAcademy\Game\Contracts\SpaceshipModules\SpaceshipModule;

interface ModulesFactory
{
    public function create($type): ?SpaceshipModule;
}