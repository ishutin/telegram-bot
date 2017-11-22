<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Document;
use Telegram\Entity\Photo;

final class DocumentTest extends TestCase
{
    public function testAttributes(): void
    {
        $fileId = 'xxxx-xxxx';
        $thumb = new Photo('xxxx', 100, 100);
        $mimeType = 'audio/mp3';
        $fileSize = 4625315;

        $document = new Document($fileId);

        $this->assertEquals($fileId, $document->getFileId());
        $this->assertNull($document->getThumb());
        $this->assertNull($document->getMimeType());
        $this->assertNull($document->getFileSize());

        $document->setThumb($thumb);
        $document->setMimeType($mimeType);
        $document->setFileSize($fileSize);

        $this->assertEquals($thumb, $document->getThumb());
        $this->assertEquals($mimeType, $document->getMimeType());
        $this->assertEquals($fileSize, $document->getFileSize());
    }
}
