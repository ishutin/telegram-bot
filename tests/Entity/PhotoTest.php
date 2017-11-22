<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Photo;

final class PhotoTest extends TestCase
{


    public function testAttributes()
    {
        $fileId = 'etlh53j53he9tn35i-h35';
        $width = 600;
        $height = 400;
        $fileSize = 1234135;

        $photo = new Photo($fileId, $width, $height);

        $this->assertEquals($fileId, $photo->getFileId());
        $this->assertEquals($width, $photo->getWidth());
        $this->assertEquals($height, $photo->getHeight());

        $this->assertNull($photo->getFileSize());

        $photo->setFileSize($fileSize);

        $this->assertEquals($fileSize, $photo->getFileSize());
    }
}
