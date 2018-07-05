<?php

namespace BinaryStudioAcademy\Game\Registries;

use BinaryStudioAcademy\Game\Contracts\Registries\Registry as RegistryContract;

class Registry implements RegistryContract, \Iterator
{
    protected $registry;

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value): void
    {
        $this->registry[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if (empty($this->registry) || !array_key_exists($key, $this->registry)) {
            return null;
        }
        return $this->registry[$key];
    }

    public function setFromArray(array $keyValuesArray): void
    {
        foreach ($keyValuesArray as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function rewind()
    {
        reset($this->registry);
    }

    public function current()
    {
        return current($this->registry);
    }

    public function key()
    {
        return key($this->registry);
    }

    public function next()
    {
        next($this->registry);
    }

    public function valid()
    {
        return isset($this->registry[key($this->registry)]);
    }
}
