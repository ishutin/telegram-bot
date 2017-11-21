<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\MessageEntity;

final class MessageEntityTest extends TestCase
{
    /**
     * @var string
     */
    private $type = 'hashtag';

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var int
     */
    private $length = 5;

    public function testProperties(): void
    {
        $entity = new MessageEntity(
            $this->type,
            $this->offset,
            $this->length
        );

        $this->assertEquals($this->type, $entity->type);
        $this->assertEquals($this->offset, $entity->offset);
        $this->assertEquals($this->length, $entity->length);
    }
}
