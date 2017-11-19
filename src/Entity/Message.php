<?php

namespace Telegram\Entity;

class Message
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $from;

    /**
     * @var Chat
     */
    private $chat;

    /**
     * @var string
     */
    private $text;

    /**
     * @var MessageEntity[]
     */
    private $entities = [];

    public function __construct(
        int $id,
        User $from,
        Chat $chat,
        string $text = null,
        array $entities = []
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->chat = $chat;
        $this->text = $text;
        $this->entities = $entities;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getText(): string
    {
        return $this->text ?? '';
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
}
