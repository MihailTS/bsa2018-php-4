<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Commands\Command as CommandContract;

class HelpCommand implements CommandContract
{

    public function execute($param)
    {
        $commandsDescription = [
            "help - show available commands list.",
            "status - show information about resource quantity and which parts of spaceship haven't built yet",
            "build:<spaceship_module> - build spaceship module. You must build them all!",
            "scheme:<spaceship_module> - show which modules/resources you're need to build module.",
            "mine:<resource_name> - add one resource item to your inventory (Gimme fuel, gimme fire \m/ )",
            "produce:<combined_resource> - produce combined resource(ex.: metal)",
            "exit - exit"
        ];
        return implode("\n", $commandsDescription);
    }
}
