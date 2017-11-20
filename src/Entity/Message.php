<?php

namespace Telegram\Entity;

/**
 * Class Message
 * @package Telegram\Entity
 *
 * @property int $id
 * @property Chat $chat
 * @property int $date
 * @property User $from
 * @property string $text
 * @property MessageEntity[] $entities
 * @property Message $replyTo
 */
class Message extends Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Chat
     */
    private $chat;

    /**
     * @var int
     */
    private $date;

    /**
     * @var User
     */
    private $from = null;

    /**
     * @var string
     */
    private $text = null;

    /**
     * @var MessageEntity[]
     */
    private $entities = [];

    /**
     * @var Message
     */
    private $replyTo = null;

    public function __construct(
        int $id,
        int $date,
        Chat $chat
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->chat = $chat;
    }

    public function setReplyTo(Message $message)
    {
        $this->replyTo = $message;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setFrom(User $from)
    {
        $this->from = $from;
    }

    /**
     * @param MessageEntity[] $entities
     */
    public function setEntities(array $entities = [])
    {
        $this->entities = $entities;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    /**
     * @return User|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return MessageEntity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * @param string $type
     *
     * @return string[]
     */
    public function getEntitiesValues(string $type)
    {
        $result = [];

        if (!empty($this->entities)) {
            foreach ($this->entities as $entity) {
                if ($entity->getType() != $type) {
                    continue;
                }

                $result[] = substr(
                    $this->text,
                    $entity->getOffset(),
                    $entity->getLength()
                );
            }
        }

        return $result;
    }

    /**
     * @return Message|null
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }
}
