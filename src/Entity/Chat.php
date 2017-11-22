<?php

namespace Telegram\Entity;

/**
 * Class Chat
 * @package Telegram\Entity
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $username
 * @property string $firstName
 * @property string $lastName
 * @property bool $allMembersAreAdministrators
 * @property ChatPhoto $photo
 * @property string $description
 * @property string $inviteLink
 * @property Message $pinnedMessage
 * @property string $stickerSetName
 * @property bool $canSetStickerSet
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

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var bool
     */
    private $allMembersAreAdministrators;

    /**
     * @var ChatPhoto
     */
    private $photo;

    /**
     * @var String
     */
    private $description;

    /**
     * @var string
     */
    private $inviteLink;

    /**
     * @var Message
     */
    private $pinnedMessage;

    /**
     * @var string
     */
    private $stickerSetName;

    /**
     * @var bool
     */
    private $canSetStickerSet;

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

    public function getTitle():? string
    {
        return $this->title;
    }

    public function getUsername():? string
    {
        return $this->username;
    }

    public function getFirstName():? string
    {
        return $this->firstName;
    }

    public function getLastName():? string
    {
        return $this->lastName;
    }

    public function getDescription():? string
    {
        return $this->description;
    }

    public function getAllMembersAreAdministrators():? bool
    {
        return $this->allMembersAreAdministrators;
    }

    public function getPhoto():? ChatPhoto
    {
        return $this->photo;
    }

    public function getInviteLink():? string
    {
        return $this->inviteLink;
    }

    public function getPinnedMessage():? Message
    {
        return $this->pinnedMessage;
    }

    public function getStickerSetName():? string
    {
        return $this->stickerSetName;
    }

    public function getCanSetStickerSet():? bool
    {
        return $this->canSetStickerSet;
    }

    public function setTitle(string $title = null)
    {
        $this->title = $title;
    }

    public function setUsername(string $username = null)
    {
        $this->username = $username;
    }

    public function setFirstName(string $firstName = null)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName = null)
    {
        $this->lastName = $lastName;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    public function setAllMembersAreAdministrators(bool $flag = null)
    {
        $this->allMembersAreAdministrators = $flag;
    }

    public function setPhoto(ChatPhoto $photo = null)
    {
        $this->photo = $photo;
    }

    public function setInviteLink(string $link = null)
    {
        $this->inviteLink = $link;
    }

    public function setPinnedMessage(Message $message = null)
    {
        $this->pinnedMessage = $message;
    }

    public function setStickerSetName(string $name = null)
    {
        $this->stickerSetName = $name;
    }

    public function setCanSetStickerSet(bool $flag = null)
    {
        $this->canSetStickerSet = $flag;
    }
}
