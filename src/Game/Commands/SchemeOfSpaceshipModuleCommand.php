<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command as CommandContract;
use BinaryStudioAcademy\Game\Contracts\GameWorld;

class SchemeOfSpaceshipModuleCommand implements CommandContract
{
    private $modulesRegistry;
    private $gameWorld;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->modulesRegistry = $gameWorld->getSpaceshipModulesRegistry();
    }

    public function execute($moduleName)
    {
        $module = $this->modulesRegistry->get($moduleName);
        if (empty($module)) {
            return "There is no such spaceship module.";
        }
        try {
            $scheme = $module->getScheme();
            return "{$moduleName} => {$scheme}";
        } catch (\RuntimeException $exception) {
            return $exception->getMessage();
        }
    }
}
