<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command;
use BinaryStudioAcademy\Game\GameWorld;

class StatusCommand implements Command
{
    private $resourceRegistry;
    private $modulesRegistry;
    private $gameWorld;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->resourceRegistry = $gameWorld->resourceRegistry;
        $this->modulesRegistry = $gameWorld->spaceshipModulesRegistry;
    }

    public function execute($param)
    {
        $resources = [];
        $builtModules = [];
        $notBuiltModules = [];

        foreach ($this->resourceRegistry as $resource) {
            /**
             * @var $resource \BinaryStudioAcademy\Game\Contracts\Resources\Resource
             */
            if ($resource->isAvailable()) {
                $resources[$resource::getName()] = $resource->getCount();
            }
        }
        foreach ($this->modulesRegistry as $module) {
            /**
             * @var $module \BinaryStudioAcademy\Game\Contracts\SpaceshipModules\SpaceshipModule
             */
            if ($module->isBuilt()) {
                $builtModules[] = $module::getName();
            } else {
                $notBuiltModules[] = $module::getName();
            }
        }
        return $this->renderStatus($resources, $builtModules, $notBuiltModules);
    }

    private function renderStatus($resources, $builtModules, $notBuiltModules)
    {
        $output = "\nYou have:\n";
        foreach ($resources as $resource => $count) {
            $output .= " * {$resource} - {$count};\n";
        }

        $output .= "\nParts ready: \n";
        foreach ($builtModules as $readyModule) {
            $output .= " * {$readyModule};\n";
        }

        $output .= "\nParts to build: \n";
        foreach ($notBuiltModules as $notBuiltModule) {
            $output .= " * {$notBuiltModule};\n";
        }

        return $output;
    }
}