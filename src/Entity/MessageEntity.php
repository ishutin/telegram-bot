<?php

namespace Telegram\Entity;

class MessageEntity extends Entity
{
    const TYPE_MENTION = 'mention';
    const TYPE_BOT_COMMAND = 'bot_command';
    const TYPE_HASHTAG = 'hashtag';
    const TYPE_URL = 'url';
    const TYPE_EMAIL = 'email';
    const TYPE_BOLD = 'bold';
    const TYPE_ITALIC = 'italic';
    const TYPE_CODE = 'code';
    const TYPE_PRE = 'pre';
    const TYPE_TEXT_LINK = 'text_link';
    const TYPE_TEXT_MENTION = 'text_mention';

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

    public function __construct(string $type, int $offset, int $length)
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
