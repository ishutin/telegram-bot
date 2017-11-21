<?php

namespace Telegram\Entity;

use ReflectionMethod;
use Telegram\Exception\EntityException;

abstract class Entity
{
    /**
     * @param $name
     * @return mixed
     * @throws EntityException
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);

        if (method_exists($this, $method)) {
            $reflection = new ReflectionMethod($this, $method);
            if ($reflection->isPublic()) {
                return $this->$method();
            }
        }

        throw new EntityException("Unknown getting property: $name");
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     * @throws EntityException
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);

        if (method_exists($this, $method)) {
            $reflection = new ReflectionMethod($this, $method);
            if ($reflection->isPublic()) {
                return $this->$method($value);
            }
        }

        throw new EntityException("Unknown property: $name");
    }
}
