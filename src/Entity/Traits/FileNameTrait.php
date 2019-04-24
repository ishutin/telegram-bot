<?php

namespace Telegram\Entity\Traits;

trait FileNameTrait
{
    /**
     * @var string
     */
    private $fileName;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName = null): void
    {
        $this->fileName = $fileName;
    }
}
