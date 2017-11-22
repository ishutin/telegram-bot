<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\Photo;
use Telegram\Entity\User;

final class MessageTest extends TestCase
{
    /**
     * @var int
     */
    private $id = 4;

    /**
     * @var int
     */
    private $date = 12341234;

    public function testProperties(): void
    {
        $message = new Message($this->id, $this->date, new Chat(1, 'private'));

        $this->assertEquals($this->id, $message->getId());
        $this->assertEquals($this->date, $message->getDate());
        $this->assertInstanceOf(Chat::class, $message->getChat());

        $this->assertEmpty($message->getEntities());
        $this->assertNull($message->getAudio());
        $this->assertNull($message->getFrom());
        $this->assertNull($message->getText());
        $this->assertNull($message->getReplyTo());
        $this->assertEmpty($message->getPhotos());

        $message->setText('test');
        $message->setAudio(new Audio('test', 1234));
        $message->setEntities([new MessageEntity('hashtag', 0, 5)]);
        $message->setFrom(new User(1, 'test', 'test', 'test', 'en', false));
        $message->setReplyTo(new Message(1, 2, new Chat(2, 'private')));
        $message->setPhotos([new Photo('test', 1, 1)]);

        $this->assertEquals('test', $message->getText());
        $this->assertNotEmpty($message->getEntities());
        $this->assertNotEmpty($message->getPhotos());

        $this->assertInstanceOf(Audio::class, $message->getAudio());
        $this->assertInstanceOf(User::class, $message->getFrom());
        $this->assertInstanceOf(Message::class, $message->getReplyTo());
    }

    public function testGetEntitiesValues(): void
    {
        $message = new Message($this->id, $this->date, new Chat(1, 'private'));

        $message->setText('#test super text');
        $message->setEntities([new MessageEntity('hashtag', 0, 5)]);

        $this->assertContains('#test', $message->getEntitiesValues('hashtag'));
    }
}
