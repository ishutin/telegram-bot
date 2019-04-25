<?php

namespace Telegram\Entity\Factory;

use Telegram\Entity\Factory\Exception\ParseException;
use Telegram\Entity\Message;
use Telegram\Entity\Update\Update;
use Telegram\Entity\User;

interface EntityFactoryInterface
{
    /**
     * @param array $data
     * @return Update
     * @throws ParseException
     */
    public function createUpdate(array $data): Update;

    /**
     * @param array $data
     * @return Message
     * @throws ParseException
     */
    public function createMessage(array $data): Message;

    /**
     * @param array $data
     * @return User
     * @throws ParseException
     */
    public function createUser(array $data): User;
}
