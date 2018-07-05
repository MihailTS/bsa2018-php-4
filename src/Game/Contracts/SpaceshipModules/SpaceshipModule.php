<?php

namespace BinaryStudioAcademy\Game\Contracts\SpaceshipModules;


interface SpaceshipModule
{
    public static function getName(): string;

    public function getScheme(): string;

    public function build();

    public function isBuilt(): bool;
}
