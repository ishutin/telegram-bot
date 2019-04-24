<?php

namespace Telegram\Entity\Factory;

use Telegram\Entity\Factory\Exception\ParseException;
use Telegram\Entity\Update\Update;

interface EntityFactoryInterface
{
    /**
     * @param array $data
     * @return Update
     * @throws ParseException
     */
    public function createUpdate(array $data): Update;
}
