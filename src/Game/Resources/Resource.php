<?php

namespace BinaryStudioAcademy\Game\Resources;

use BinaryStudioAcademy\Game\Contracts\Resources\Resource as ResourceContract;
use BinaryStudioAcademy\Game\Contracts\SpaceshipModules\SpaceshipModulePart;

abstract class Resource implements ResourceContract, SpaceshipModulePart
{
    protected static $name;
    protected $count = 0;
    protected $produceResources;

    public static function getName(): string
    {
        return static::$name;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function isAvailable(): bool
    {
        return $this->getCount() > 0;
    }

    public function useToBuild()
    {
        $this->take();
    }

    protected function add(): int
    {
        $this->count++;
        return $this->count;
    }

    protected function take(): int
    {
        if ($this->count > 0) {
            $this->count--;
            return $this->count;
        } else {
            $name = self::getName();
            throw(new \RuntimeException("Not enough resource: {$name}"));
        }
    }
}
