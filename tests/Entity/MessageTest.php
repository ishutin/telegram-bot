<?php

namespace Test\Entity;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\PhotoSize;
use Telegram\Entity\User;

final class MessageTest extends TestCase
{
    public function testProperties(): void
    {
        $id = 4;
        $date = 43134134;
        $text = 'test_text';
        $audio = new Audio('test', 1234);
        $entities = [new MessageEntity('hashtag', 0, 5)];
        $from = new User(1, 'test', 'test', 'test', 'en', false);
        $replyTo = new Message(1, 2, new Chat(2, 'private'));
        $photos = [new PhotoSize('test', 1, 1)];

        $message = new Message($id, $date, new Chat(1, 'private'));

        $this->assertEquals($id, $message->getId());
        $this->assertEquals($date, $message->getDate());

        $this->assertEmpty($message->getEntities());
        $this->assertNull($message->getAudio());
        $this->assertNull($message->getFrom());
        $this->assertNull($message->getText());
        $this->assertNull($message->getReplyToMessage());
        $this->assertEmpty($message->getPhoto());


        $message->setText($text);
        $message->setAudio($audio);
        $message->setEntities($entities);
        $message->setFrom($from);
        $message->setReplyToMessage($replyTo);
        $message->setPhoto($photos);

        $this->assertEquals($text, $message->getText());
        $this->assertEquals($audio, $message->getAudio());
        $this->assertEquals($entities, $message->getEntities());
        $this->assertEquals($from, $message->getFrom());
        $this->assertEquals($replyTo, $message->getReplyToMessage());
        $this->assertEquals($photos, $message->getPhoto());

        $this->assertInstanceOf(Audio::class, $message->getAudio());
        $this->assertInstanceOf(User::class, $message->getFrom());
        $this->assertInstanceOf(Message::class, $message->getReplyToMessage());
    }

    public function testGetEntitiesValues(): void
    {
        $id = 4;
        $date = 43134134;

        $message = new Message($id, $date, new Chat(1, 'private'));

        $message->setText('#test super text');
        $message->setEntities([new MessageEntity('hashtag', 0, 5)]);

        $this->assertContains('#test', $message->getEntitiesValues('hashtag'));
    }
}
