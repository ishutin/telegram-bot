<?php

namespace Telegram\Entity\Traits;

trait FileMimeTrait
{
    /**
     * @var int
     */
    protected $mimeType;

    public function setMimeType(?string $type): void
    {
        $this->mimeType = $type;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }
}
