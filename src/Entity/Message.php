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
 * @property Audio $audio
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

    /**
     * @var Audio
     */
    private $audio;

    public function __construct(
        int $id,
        int $date,
        Chat $chat
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->chat = $chat;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function getFrom():? User
    {
        return $this->from;
    }

    public function getText():? string
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
                if ($entity->type != $type) {
                    continue;
                }

                $result[] = substr(
                    $this->text,
                    $entity->offset,
                    $entity->length
                );
            }
        }

        return $result;
    }

    public function getReplyTo():? Message
    {
        return $this->replyTo;
    }

    public function getAudio():? Audio
    {
        return $this->audio;
    }

    public function setReplyTo(Message $message = null)
    {
        $this->replyTo = $message;
    }

    public function setText(string $text = null)
    {
        $this->text = $text;
    }

    public function setFrom(User $from = null)
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

    public function setAudio(Audio $audio = null)
    {
        $this->audio = $audio;
    }
}
