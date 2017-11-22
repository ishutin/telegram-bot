<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\MessageEntity;

final class MessageEntityTest extends TestCase
{
    public function testProperties(): void
    {
        $type = 'hashtag';
        $offset = 0;
        $length = 5;

        $entity = new MessageEntity($type, $offset, $length);

        $this->assertEquals($type, $entity->getType());
        $this->assertEquals($offset, $entity->getOffset());
        $this->assertEquals($length, $entity->getLength());
    }
}
