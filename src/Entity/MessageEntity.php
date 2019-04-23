<?php

namespace Telegram\Entity;

class MessageEntity
{
    public const TYPE_MENTION = 'mention';
    public const TYPE_BOT_COMMAND = 'bot_command';
    public const TYPE_HASHTAG = 'hashtag';
    public const TYPE_URL = 'url';
    public const TYPE_EMAIL = 'email';
    public const TYPE_BOLD = 'bold';
    public const TYPE_ITALIC = 'italic';
    public const TYPE_CODE = 'code';
    public const TYPE_PRE = 'pre';
    public const TYPE_TEXT_LINK = 'text_link';
    public const TYPE_TEXT_MENTION = 'text_mention';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var int
     */
    protected $length;

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
