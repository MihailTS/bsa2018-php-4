<?php

namespace BinaryStudioAcademy\Game\SpaceshipModules;

use BinaryStudioAcademy\Game\Contracts\SpaceshipModules\SpaceshipModule as SpaceshipModuleContract;
use BinaryStudioAcademy\Game\Contracts\SpaceshipModules\SpaceshipModulePart;

abstract class SpaceshipModule implements SpaceshipModuleContract, SpaceshipModulePart
{
    protected static $name;
    protected $isBuilt = false;
    protected $moduleParts = [];

    public function __construct(SpaceshipModulePart ...$moduleParts)
    {
        $this->moduleParts = $moduleParts;
    }

    public static function getName(): string
    {
        return static::$name;
    }

    public function getScheme(): string
    {
        $partNames = [];
        foreach ($this->moduleParts as $part) {
            $partNames[] = $part::getName();
        }
        return implode('|', $partNames);
    }

    public function isBuilt(): bool
    {
        return $this->isBuilt;
    }

    public function build()
    {
        $canBuild = true;
        $notEnoughResourcesNames = [];

        foreach ($this->moduleParts as $part) {
            if (!$part->isAvailable()) {
                $notEnoughResourcesNames[] = $part::getName();
                $canBuild = false;
            }
        }

        if (!$canBuild) {
            $notEnoughResourcesString = implode(",", $notEnoughResourcesNames);
            throw(new \RuntimeException("Inventory should have: {$notEnoughResourcesString}."));
        }

        foreach ($this->moduleParts as $part) {
            $part->useToBuild();
        }

        $this->isBuilt = true;
    }

    public function isAvailable(): bool
    {
        return $this->isBuilt();
    }

    public function useToBuild()
    {
        //modules aren't wasting for building - we have to build them all
    }

}
