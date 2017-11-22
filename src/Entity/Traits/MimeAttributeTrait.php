<?php

namespace Telegram\Entity\Traits;

trait MimeAttributeTrait
{
    /**
     * @var int
     */
    private $mimeType;

    public function setMimeType(string $type = null): void
    {
        $this->mimeType = $type;
    }

    public function getMimeType():? string
    {
        return $this->mimeType;
    }
}
