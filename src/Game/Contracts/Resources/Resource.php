<?php

namespace BinaryStudioAcademy\Game\Contracts\Resources;

interface Resource
{
    public static function getName(): string;

    public function getCount(): int;

    public function isAvailable(): bool;
}
