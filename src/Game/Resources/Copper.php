<?php

namespace BinaryStudioAcademy\Game\Resources;

use BinaryStudioAcademy\Game\Contracts\Resources\MineableResource;
use BinaryStudioAcademy\Game\Traits\Resources\SimpleMine;

class Copper extends Resource implements MineableResource
{

    use SimpleMine;

    protected static $name = "copper";

}
