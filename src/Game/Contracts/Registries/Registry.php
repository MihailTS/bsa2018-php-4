<?php

namespace BinaryStudioAcademy\Game\Contracts\Registries;


interface Registry
{
    public function set($key, $value): void;

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param array $values
     */
    public function setFromArray(array $values): void;
}