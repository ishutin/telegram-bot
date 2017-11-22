<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Photo;

final class PhotoTest extends TestCase
{
    /**
     * @var string
     */
    private $fileId = 'etlh53j53he9tn35i-h35';

    /**
     * @var int
     */
    private $width = 600;

    /**
     * @var int
     */
    private $height = 400;

    /**
     * @var int
     */
    private $fileSize = 1234135;

    public function testAttributes()
    {
        $photo = new Photo($this->fileId, $this->width, $this->height);

        $this->assertNull($photo->getFileSize());

        $this->assertEquals($this->fileId, $photo->getFileId());
        $this->assertEquals($this->width, $photo->getWidth());
        $this->assertEquals($this->height, $photo->getHeight());

        $photo->setFileSize($this->fileSize);

        $this->assertEquals($this->fileSize, $photo->getFileSize());
    }
}
