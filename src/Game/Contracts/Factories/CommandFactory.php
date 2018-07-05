<?php

namespace BinaryStudioAcademy\Game\Contracts\Factories;

use BinaryStudioAcademy\Game\Contracts\Commands\Command;

interface CommandFactory
{
    public function create($type): ?Command;
}