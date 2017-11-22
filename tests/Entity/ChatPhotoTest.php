<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\ChatPhoto;

final class ChatPhotoTest extends TestCase
{
    public function testAttributes(): void
    {
        $smallFileId = 'xxxx';
        $bigFileId = 'zzzz';

        $photo = new ChatPhoto($smallFileId, $bigFileId);

        $this->assertEquals($smallFileId, $photo->getSmallFileId());
        $this->assertEquals($bigFileId, $photo->getBigFileId());
    }
}
