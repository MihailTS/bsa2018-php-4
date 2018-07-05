<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command as CommandContract;
use BinaryStudioAcademy\Game\Contracts\GameWorld;

class BuildSpaceshipModuleCommand implements CommandContract
{
    private $modulesRegistry;
    private $gameWorld;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->modulesRegistry = $this->gameWorld->getSpaceshipModulesRegistry();
    }

    public function execute($moduleName)
    {
        $module = $this->modulesRegistry->get($moduleName);
        if (empty($module)) {
            return "There is no such spaceship module.";
        }
        try {
            if ($module->isBuilt()) {
                return "Attention! " . ucfirst($moduleName) . " is ready.";
            }
            $module->build();
            $output = "{$moduleName} is ready!";

            if ($this->gameWorld->isVictory()) {
                $output .= " => You won!";
            }
            return $output;
        } catch (\RuntimeException $exception) {
            return $exception->getMessage();
        }
    }

}
