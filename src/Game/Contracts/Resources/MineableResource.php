<?php

namespace BinaryStudioAcademy\Game\Contracts\Resources;

interface MineableResource
{
    public function mine(): int;
}