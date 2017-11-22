<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\User;
use Telegram\Request;
use Telegram\RequestInterface;

final class RequestTest extends TestCase
{
    /**
     * @var array
     */
    private $testRequest = [
        'update_id' => 1234,
        'message' => [
            'message_id' => 4321,
            'from' => [
                'id' => 9999,
                'is_bot' => false,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'language_code' => 'en',
            ],
            'chat' => [
                'id' => 777,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'type' => 'private',
            ],
            'date' => 1511091561,
            'text' => '#test test text message',
            'entities' => [
                ['type' => 'hashtag', 'offset' => 0, 'length' => '5'],
            ],
            'audio' => [
                'file_id' => 'jwegjkwnl',
                'duration' => 4321,
            ],
            'photo' => [
                ['file_id' => 'asdasd', 'width' => 100, 'height' => 200],
            ],
        ],
    ];

    public function testParseRequest(): void
    {
        $request = new Request($this->testRequest);
        $this->assertInstanceOf(RequestInterface::class, $request);

        $message = $request->getMessage();
        $this->assertInstanceOf(Message::class, $message);

        $this->assertEquals($this->testRequest, $request->getOriginalRequest());
    }

    public function testRequestMessage(): void
    {
        $testReq = $this->testRequest;
        $request = new Request($testReq);

        $message = $request->getMessage();
        $this->assertEquals($message->id, $testReq['message']['message_id']);
        $this->assertEquals($message->date, $testReq['message']['date']);

        $chat = $message->chat;
        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertEquals($chat->type, $chat::TYPE_PRIVATE_CHAT);
        $this->assertEquals($chat->id, $testReq['message']['chat']['id']);

        $from = $message->from;
        $this->assertInstanceOf(User::class, $from);
        $this->assertEquals($from->id, $testReq['message']['from']['id']);
        $this->assertEquals($from->isBot, $testReq['message']['from']['is_bot']);
        $this->assertEquals($from->firstName, $testReq['message']['from']['first_name']);
        $this->assertEquals($from->lastName, $testReq['message']['from']['last_name']);
        $this->assertEquals($from->username, $testReq['message']['from']['username']);
        $this->assertEquals($from->lang, $testReq['message']['from']['language_code']);

        $this->assertEquals($message->text, $testReq['message']['text']);

        $this->assertNotEmpty($message->entities);

        $audio = $message->audio;
        $this->assertInstanceOf(Audio::class, $audio);
        $this->assertEquals($audio->id, $testReq['message']['audio']['file_id']);
        $this->assertEquals($audio->duration, $testReq['message']['audio']['duration']);

        $photos = $message->photos;
        $this->assertNotEmpty($photos);
    }

    public function testAttachedRequest(): void
    {
        $request = new class implements RequestInterface
        {
            public function getMessage(): Message
            {
                return new Message(2, 1234, new Chat(1, 'private'));
            }
        };

        $message = $request->getMessage();
        $this->assertInstanceOf(Message::class, $message);

        $this->assertEquals($message->id, 2);
        $this->assertEquals($message->date, 1234);
    }
}
