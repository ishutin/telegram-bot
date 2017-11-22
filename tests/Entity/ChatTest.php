<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Chat;

final class ChatTest extends TestCase
{
    /**
     * @var int
     */
    private $id = 4;

    /**
     * @var string
     */
    private $type = 'private';

    public function testProperties(): void
    {
        $chat = new Chat($this->id, $this->type);

        $this->assertEquals($this->id, $chat->getId());
        $this->assertEquals($this->type, $chat->getType());
    }
}
