<?php

namespace Telegram\Entity;

class Message
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Chat
     */
    protected $chat;

    /**
     * @var int
     */
    protected $date;

    /**
     * @var User
     */
    protected $from;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var MessageEntity[]
     */
    protected $entities = [];

    /**
     * @var Message
     */
    protected $replyTo;

    /**
     * @var Audio
     */
    protected $audio;

    /**
     * @var Photo[]
     */
    protected $photos = [];

    /**
     * @var User
     */
    protected $leftChatMember;

    /**
     * @var Chat
     */
    protected $forwardFromChat;

    /**
     * @var Document
     */
    protected $document;

    public function __construct(int $id, int $date, Chat $chat)
    {
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

    public function getFrom(): ?User
    {
        return $this->from;
    }

    public function getText(): ?string
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
    public function getEntitiesValues(string $type): array
    {
        $result = [];

        if (!empty($this->entities)) {
            foreach ($this->entities as $entity) {
                if ($entity->getType() !== $type) {
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

    public function getReplyTo(): ?Message
    {
        return $this->replyTo;
    }

    public function getAudio(): ?Audio
    {
        return $this->audio;
    }

    /**
     * @return Photo[]
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getLeftChatMember(): ?User
    {
        return $this->leftChatMember;
    }

    public function getForwardFromChat(): ?Chat
    {
        return $this->forwardFromChat;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setReplyTo(Message $message = null): void
    {
        $this->replyTo = $message;
    }

    public function setText(string $text = null): void
    {
        $this->text = $text;
    }

    public function setFrom(User $from = null): void
    {
        $this->from = $from;
    }

    /**
     * @param MessageEntity[] $entities
     */
    public function setEntities(array $entities = []): void
    {
        $this->entities = $entities;
    }

    public function setAudio(Audio $audio = null): void
    {
        $this->audio = $audio;
    }

    public function setPhotos(array $photos = []): void
    {
        $this->photos = $photos;
    }

    public function setLeftChatMember(User $user = null): void
    {
        $this->leftChatMember = $user;
    }

    public function setForwardFromChat(Chat $chat = null): void
    {
        $this->forwardFromChat = $chat;
    }

    public function setDocument(Document $document = null): void
    {
        $this->document = $document;
    }
}
