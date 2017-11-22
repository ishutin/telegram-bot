<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;

final class AudioTest extends TestCase
{
    /**
     * @var string
     */
    private $fileId = 'asdasdasd';

    /**
     * @var int
     */
    private $duration = 350;

    /**
     * @var string
     */
    private $performer = 'Wolfgang Amadeus Mozart';

    /**
     * @var string
     */
    private $title = 'Symphony No. 25 in G minor, K. 183';

    /**
     * @var string
     */
    private $mimeType = 'audio/mp4';

    /**
     * @var int
     */
    private $fileSize = 123415;

    public function testProperties(): void
    {
        $audio = new Audio($this->fileId, $this->duration);

        $this->assertEquals($this->fileId, $audio->getFileId());
        $this->assertEquals($this->duration, $audio->getDuration());
        $this->assertNull($audio->getPerformer());
        $this->assertNull($audio->getTitle());
        $this->assertNull($audio->getMimeType());
        $this->assertNull($audio->getFileSize());

        $audio->setPerformer($this->performer);
        $audio->setTitle($this->title);
        $audio->setMimeType($this->mimeType);
        $audio->setFileSize($this->fileSize);

        $this->assertEquals($this->performer, $audio->getPerformer());
        $this->assertEquals($this->title, $audio->getTitle());
        $this->assertEquals($this->mimeType, $audio->getMimeType());
        $this->assertEquals($this->fileSize, $audio->getFileSize());
    }
}
