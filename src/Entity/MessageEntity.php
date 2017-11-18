<?php

namespace Telegram\Entity;

class MessageEntity
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $length;

    public function __construct(string $type, integer $offset, integer $length)
    {
        $this->type = $type;
        $this->offset = $offset;
        $this->length = $length;
    }
}
