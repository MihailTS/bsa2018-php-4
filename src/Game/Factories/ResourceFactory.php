<?php

namespace BinaryStudioAcademy\Game\Factories;

use BinaryStudioAcademy\Game\Contracts\Factories\ResourceFactory as ResourceFactoryContract;
use BinaryStudioAcademy\Game\Contracts\GameWorld;
use BinaryStudioAcademy\Game\Contracts\Resources\Resource;
use BinaryStudioAcademy\Game\Resources;

class ResourceFactory implements ResourceFactoryContract
{
    protected $resourceRegistry;
    protected $gameWorld;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->resourceRegistry = $gameWorld->getResourceRegistry();
    }

    public function create($type): ?Resource
    {
        switch ($type) {
            case 'fire':
                $resource = new Resources\Fire;
                break;
            case 'iron':
                $resource = new Resources\Iron;
                break;
            case 'sand':
                $resource = new Resources\Sand;
                break;
            case 'water':
                $resource = new Resources\Water;
                break;
            case 'fuel':
                $resource = new Resources\Fuel;
                break;
            case 'copper':
                $resource = new Resources\Copper;
                break;
            case 'carbon':
                $resource = new Resources\Carbon;
                break;
            case 'silicon':
                $resource = new Resources\Silicon;
                break;
            case 'metal':
                $iron = $this->resourceRegistry->get('iron');
                $fire = $this->resourceRegistry->get('fire');
                if (empty($iron)) {
                    $iron = $this->create('iron');
                }
                if (empty($fire)) {
                    $iron = $this->create('fire');
                }
                $resource = new Resources\Metal($iron, $fire);
                break;
            default:
                return null;
        }
        $this->resourceRegistry->set($type, $resource);

        return $resource;
    }
}
