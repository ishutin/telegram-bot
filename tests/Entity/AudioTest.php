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
    private $title = 'ymphony No. 25 in G minor, K. 183';

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
        $audio->performer = $this->performer;
        $audio->title = $this->title;
        $audio->mimeType = $this->mimeType;
        $audio->fileSize = $this->fileSize;

        $this->assertEquals($this->fileId, $audio->id);
        $this->assertEquals($this->duration, $audio->duration);
        $this->assertEquals($this->performer, $audio->performer);
        $this->assertEquals($this->title, $audio->title);
        $this->assertEquals($this->mimeType, $audio->mimeType);
        $this->assertEquals($this->fileSize, $audio->fileSize);
    }
}
