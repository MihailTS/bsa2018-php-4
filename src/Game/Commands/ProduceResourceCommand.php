<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command as CommandContract;
use BinaryStudioAcademy\Game\Contracts\Resources\ProduceableResource;
use BinaryStudioAcademy\Game\GameWorld;

class ProduceResourceCommand implements CommandContract
{
    private $resourceRegistry;
    private $gameWorld;

    public function __construct(GameWorld $gameWorld)
    {
        $this->gameWorld = $gameWorld;
        $this->resourceRegistry = $gameWorld->resourceRegistry;
    }

    public function execute($resourceName)
    {
        $resource = $this->resourceRegistry->get($resourceName);
        if ($resource instanceof ProduceableResource) {
            try {
                $resource->produce();
                return "{$resource::getName()} added to inventory.";
            } catch (\RuntimeException $exception) {
                return $exception->getMessage();
            }
        } else {
            return "Can't produce resource {$resourceName}. Maybe you meant \"mine:{$resourceName}\"?";
        }
    }
}
