<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\User;

final class UserTest extends TestCase
{
    public function testAttributes(): void
    {
        $id = 1;
        $firstName = 'UNIT';
        $lastName = 'TEST';
        $username = '@unit_test';
        $lang = 'en';
        $isBot = false;

        $user = new User(
            $id,
            $firstName,
            $isBot
        );

        $user->setLanguageCode($lang);
        $user->setUsername($username);
        $user->setLastName($lastName);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($firstName, $user->getFirstName());
        $this->assertEquals($lastName, $user->getLastName());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($lang, $user->getLanguageCode());
        $this->assertEquals($isBot, $user->getIsBot());
    }
}
