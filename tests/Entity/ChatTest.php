<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Chat;
use Telegram\Entity\ChatPhoto;
use Telegram\Entity\Message;
use Telegram\Entity\Photo;

final class ChatTest extends TestCase
{
    public function testProperties(): void
    {
        $id = 4;
        $type = 'private';
        $title = 'test_title';
        $username = 'test_username';
        $firstName = 'test_firstName';
        $lastName = 'test_lastName';
        $allMembersAreAdmins = true;
        $description = 'test_description';
        $inviteLink = 'https://tlg.in/vite';
        $stickerSetName = 'test_stickerSetName';
        $canSetStickerSet = false;
        $pinnedMessage = new Message(1, 1, new Chat(1, 'private'));
        $photo = new ChatPhoto('xxxx', 'zzzz');

        $chat = new Chat($id, $type);

        $this->assertEquals($id, $chat->getId());
        $this->assertEquals($type, $chat->getType());

        $this->assertNull($chat->getTitle());
        $this->assertNull($chat->getUsername());
        $this->assertNull($chat->getFirstName());
        $this->assertNull($chat->getLastName());
        $this->assertNull($chat->getAllMembersAreAdministrators());
        $this->assertNull($chat->getDescription());
        $this->assertNull($chat->getInviteLink());
        $this->assertNull($chat->getStickerSetName());
        $this->assertNull($chat->getCanSetStickerSet());
        $this->assertNull($chat->getPinnedMessage());
        $this->assertNull($chat->getPhoto());

        // Set null attributes
        $chat->setTitle($title);
        $chat->setUsername($username);
        $chat->setFirstName($firstName);
        $chat->setLastName($lastName);
        $chat->setAllMembersAreAdministrators($allMembersAreAdmins);
        $chat->setDescription($description);
        $chat->setInviteLink($inviteLink);
        $chat->setStickerSetName($stickerSetName);
        $chat->setCanSetStickerSet($canSetStickerSet);
        $chat->setPinnedMessage($pinnedMessage);
        $chat->setPhoto($photo);

        $this->assertEquals($title, $chat->getTitle());
        $this->assertEquals($username, $chat->getUsername());
        $this->assertEquals($firstName, $chat->getFirstName());
        $this->assertEquals($lastName, $chat->getLastName());
        $this->assertEquals($allMembersAreAdmins, $chat->getAllMembersAreAdministrators());
        $this->assertEquals($description, $chat->getDescription());
        $this->assertEquals($inviteLink, $chat->getInviteLink());
        $this->assertEquals($stickerSetName, $chat->getStickerSetName());
        $this->assertEquals($canSetStickerSet, $chat->getCanSetStickerSet());
        $this->assertEquals($pinnedMessage, $chat->getPinnedMessage());
        $this->assertEquals($photo, $chat->getPhoto());
    }
}
