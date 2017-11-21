<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;

final class MessageTest extends TestCase
{
    /**
     * @var int
     */
    private $id = 4;

    /**
     * @var int
     */
    private $date = 12341234;

    public function testProperties(): void
    {
        $message = new Message(
            $this->id,
            $this->date,
            new Chat(1, 'private')
        );

        $this->assertEquals($this->id, $message->id);
        $this->assertEquals($this->date, $message->date);
    }
}
