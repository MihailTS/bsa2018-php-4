<?php

namespace BinaryStudioAcademy\Game\Resources;

use BinaryStudioAcademy\Game\Contracts\Resources\ProduceableResource as ProduceableResourceContract;
use BinaryStudioAcademy\Game\Contracts\Resources\Resource as ResourceContract;
use BinaryStudioAcademy\Game\Resources\Resource as Resource;

abstract class ProduceableResource extends Resource implements ProduceableResourceContract
{
    protected $count = 0;
    protected $produceResources = [];
    protected static $name;

    public function __construct(ResourceContract ...$produceResources)
    {
        $this->produceResources = $produceResources;
    }

    public function produce(): int
    {
        $canProduce = true;
        $notEnoughResourcesNames = [];

        foreach ($this->produceResources as $resource) {
            if (!$resource->isAvailable()) {
                $notEnoughResourcesNames[] = $resource::getName();
                $canProduce = false;
            }
        }

        if (!$canProduce) {
            $notEnoughResourcesString = implode(",", $notEnoughResourcesNames);
            throw(new \RuntimeException("You need to mine: {$notEnoughResourcesString}."));
        }

        foreach ($this->produceResources as $resource) {
            $resource->take();
        }

        return $this->add();
    }
}
