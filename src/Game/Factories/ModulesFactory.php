<?php

namespace BinaryStudioAcademy\Game\Factories;

use BinaryStudioAcademy\Game\Contracts\Factories\ModulesFactory as ModulesFactoryContract;
use BinaryStudioAcademy\Game\Contracts\GameWorld;
use BinaryStudioAcademy\Game\Contracts\SpaceshipModules\SpaceshipModule as SpaceshipModuleContract;
use BinaryStudioAcademy\Game\SpaceshipModules;

class ModulesFactory implements ModulesFactoryContract
{
    protected $gameWorld;
    protected $modulesRegistry;
    protected $resourceRegistry;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->modulesRegistry = $gameWorld->getSpaceshipModulesRegistry();
        $this->resourceRegistry = $gameWorld->getResourceRegistry();
    }

    public function create($type): ?SpaceshipModuleContract
    {
        $metal = $this->resourceRegistry->get('metal');
        $silicon = $this->resourceRegistry->get('silicon');
        $copper = $this->resourceRegistry->get('copper');
        $fire = $this->resourceRegistry->get('fire');
        $carbon = $this->resourceRegistry->get('carbon');
        $water = $this->resourceRegistry->get('water');
        $fuel = $this->resourceRegistry->get('fuel');
        $sand = $this->resourceRegistry->get('sand');

        switch ($type) {
            case 'ic':
                $module = new SpaceshipModules\ICModule($metal, $silicon);
                break;
            case 'wires':
                $module = new SpaceshipModules\WiresModule($copper, $fire);
                break;
            case 'control_unit':
                $ic = $this->modulesRegistry->get('ic');
                $wires = $this->modulesRegistry->get('wires');

                if (empty($ic)) {
                    $ic = $this->create('ic');
                }
                if (empty($wires)) {
                    $wires = $this->create('wires');
                }

                $module = new SpaceshipModules\ControlUnitModule($ic, $wires);
                break;
            case 'engine':
                $module = new SpaceshipModules\EngineModule($metal, $carbon, $fire);
                break;
            case 'launcher':
                $module = new SpaceshipModules\LauncherModule($water, $fire, $fuel);
                break;
            case 'porthole':
                $module = new SpaceshipModules\PortholeModule($sand, $fire);
                break;
            case 'shell':
                $module = new SpaceshipModules\ShellModule($metal, $fire);
                break;
            case 'tank':
                $module = new SpaceshipModules\TankModule($metal, $fuel);
                break;
            default:
                return null;
        }
        $this->modulesRegistry->set($type, $module);

        return $module;
    }
}
