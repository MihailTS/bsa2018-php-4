<?php

namespace BinaryStudioAcademy\Game\Contracts\Factories;

use BinaryStudioAcademy\Game\Contracts\Resources\Resource;


interface ResourceFactory
{
    public function create($type): ?Resource;
}