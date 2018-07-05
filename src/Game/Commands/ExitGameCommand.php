<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command as CommandContract;
use BinaryStudioAcademy\Game\GameWorld;

class ExitGameCommand implements CommandContract
{
    private $game;

    public function __construct(GameWorld $game)
    {
        $this->game = $game;
    }

    public function execute($param)
    {
        $this->game->exit();
    }

}
