<?php

namespace Telegram\Entity;

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
        $method = "get$name";
        if (method_exists($this, $method)) {
            $result = $this->$method();

            return $result;
        }

        throw new EntityException('Getting unknown property: ' . get_class($this) . '.' . $name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     * @throws EntityException
     */
    public function __set($name, $value)
    {
        $method = "set$name";

        if (method_exists($this, $method)) {
            $this->$method($value);

            return;
        }

        throw new EntityException('Setting unknown property: ' . get_class($this) . '.' . $name);
    }
}
