<?php

namespace Telegram\Entity;

/**
 * Class Chat
 * @package Telegram\Entity
 *
 * @property int $id
 * @property string $type
 */
class Chat extends Entity
{
    const TYPE_PRIVATE_CHAT = 'private';
    const TYPE_GROUP_CHAT = 'group';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    public function __construct(int $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

}
