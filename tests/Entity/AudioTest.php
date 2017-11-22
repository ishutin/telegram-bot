<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;

final class AudioTest extends TestCase
{
    public function testProperties(): void
    {
        $fileId = 'asdasdasd';
        $duration = 350;
        $performer = 'Wolfgang Amadeus Mozart';
        $title = 'Symphony No. 25 in G minor, K. 183';
        $mimeType = 'audio/mp4';
        $fileSize = 123415;

        $audio = new Audio($fileId, $duration);

        $this->assertEquals($fileId, $audio->getFileId());
        $this->assertEquals($duration, $audio->getDuration());
        $this->assertNull($audio->getPerformer());
        $this->assertNull($audio->getTitle());
        $this->assertNull($audio->getMimeType());
        $this->assertNull($audio->getFileSize());

        $audio->setPerformer($performer);
        $audio->setTitle($title);
        $audio->setMimeType($mimeType);
        $audio->setFileSize($fileSize);

        $this->assertEquals($performer, $audio->getPerformer());
        $this->assertEquals($title, $audio->getTitle());
        $this->assertEquals($mimeType, $audio->getMimeType());
        $this->assertEquals($fileSize, $audio->getFileSize());
    }
}
