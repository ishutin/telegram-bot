<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Photo;

final class PhotoTest extends TestCase
{
    /**
     * @var string
     */
    private $id = 'etlh53j53he9tn35i-h35';

    /**
     * @var int
     */
    private $width = 600;

    /**
     * @var int
     */
    private $height = 400;

    private $fileSize = 1234135;

    public function testAttributes()
    {
        $photo = new Photo($this->id, $this->width, $this->height);

        $this->assertNull($photo->fileSize);

        $this->assertEquals($this->id, $photo->id);
        $this->assertEquals($this->width, $photo->width);
        $this->assertEquals($this->height, $photo->height);

        $photo->fileSize = $this->fileSize;

        $this->assertEquals($this->fileSize, $photo->fileSize);
    }
}
