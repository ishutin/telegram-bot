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
        $message = new Message(
            $this->id,
            $this->date,
            new Chat(1, 'private')
        );

        $this->assertEquals($this->id, $message->id);
        $this->assertEquals($this->date, $message->date);
        $this->assertInstanceOf(Chat::class, $message->chat);

        $this->assertEmpty($message->entities);
        $this->assertNull($message->audio);
        $this->assertNull($message->from);
        $this->assertNull($message->text);
        $this->assertNull($message->replyTo);
        $this->assertEmpty($message->photos);

        $message->text = 'test';
        $message->audio = new Audio('test', 1234);
        $message->entities = [new MessageEntity('hashtag', 0, 5)];
        $message->from = new User(1, 'test', 'test', 'test', 'en', false);
        $message->replyTo = new Message(1, 2, new Chat(2, 'private'));
        $message->photos = [new Photo('test', 1, 1)];

        $this->assertEquals('test', $message->text);
        $this->assertNotEmpty($message->entities);
        $this->assertNotEmpty($message->photos);

        $this->assertInstanceOf(Audio::class, $message->audio);
        $this->assertInstanceOf(User::class, $message->from);
        $this->assertInstanceOf(Message::class, $message->replyTo);
    }

    public function testGetEntitiesValues(): void
    {
        $message = new Message(
            $this->id,
            $this->date,
            new Chat(1, 'private')
        );

        $message->text = '#test super text';
        $message->entities = [new MessageEntity('hashtag', 0, 5)];

        $this->assertContains(
            '#test',
            $message->getEntitiesValues('hashtag')
        );
    }
}
