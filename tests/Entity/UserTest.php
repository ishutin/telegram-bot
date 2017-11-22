<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\User;

final class UserTest extends TestCase
{
    /**
     * @var int
     */
    private $id = 1;

    /**
     * @var string
     */
    private $firstName = 'UNIT';

    /**
     * @var string
     */
    private $lastName = 'TEST';

    /**
     * @var string
     */
    private $username = '@unit_test';

    /**
     * @var string
     */
    private $lang = 'en';

    /**
     * @var bool
     */
    private $isBot = false;

    public function testAttributes(): void
    {
        $user = new User(
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->username,
            $this->lang,
            $this->isBot
        );

        $this->assertEquals($this->id, $user->getId());
        $this->assertEquals($this->firstName, $user->getFirstName());
        $this->assertEquals($this->lastName, $user->getLastName());
        $this->assertEquals($this->username, $user->getUsername());
        $this->assertEquals($this->lang, $user->getLang());
        $this->assertEquals($this->isBot, $user->getIsBot());
    }
}
