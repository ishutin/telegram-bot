<?php

namespace Telegram\Entity;

class MessageEntity
{
    const TYPE_BOT_COMMAND = 'bot_command';

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

    public function getType(): string
    {
        return $this->type;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLength(): int
    {
        return $this->length;
    }
}
