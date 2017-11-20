<?php

namespace Telegram\Entity;

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
            return $this->$method();
        }

        return null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return null
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return null;
    }
}
