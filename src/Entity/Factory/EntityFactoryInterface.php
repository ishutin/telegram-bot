<?php

namespace Telegram\Entity\Factory;

use Telegram\Entity\Update;
use Telegram\Kernel\Exception\EntityParserException;

interface EntityFactoryInterface
{
    /**
     * @param array $data
     * @return Update
     * @throws EntityParserException
     */
    public function createUpdate(array $data): Update;
}
