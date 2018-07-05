<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command as CommandContract;
use BinaryStudioAcademy\Game\Contracts\GameWorld;
use BinaryStudioAcademy\Game\Contracts\Resources\MineableResource;

class MineResourceCommand implements CommandContract
{
    private $resourceRegistry;
    private $gameWorld;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->resourceRegistry = $gameWorld->getResourceRegistry();
    }

    public function execute($resourceName)
    {
        $resource = $this->resourceRegistry->get($resourceName);
        if ($resource instanceof MineableResource) {
            try {
                $resource->mine();
                return "{$resource::getName()} added to inventory.";
            } catch (\RuntimeException $exception) {
                return $exception->getMessage();
            }
        } else {
            return "No such resource.";
        }
    }
}