<?php

namespace Telegram\Entity;

use ReflectionMethod;

abstract class Entity
{
    /**
     * @param string $name
     * @return mixed
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

        return null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
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

        return null;
    }
}
