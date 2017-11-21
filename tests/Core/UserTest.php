<?php

namespace Test\Core;

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

        $this->assertEquals($this->id, $user->id);
        $this->assertEquals($this->firstName, $user->firstName);
        $this->assertEquals($this->lastName, $user->lastName);
        $this->assertEquals($this->username, $user->username);
        $this->assertEquals($this->lang, $user->lang);
        $this->assertEquals($this->isBot, $user->isBot);
    }
}
