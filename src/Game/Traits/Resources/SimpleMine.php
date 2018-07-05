<?php

namespace BinaryStudioAcademy\Game\Traits\Resources;

trait SimpleMine
{
    public function mine(): int
    {
        return $this->add();
    }
}