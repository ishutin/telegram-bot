<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Chat;
use Telegram\Entity\User;
use Telegram\Request;

final class MessageTest extends TestCase
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
            'text' => 'test text message',
        ],
    ];

    public function testMessage()
    {
        $testReq = $this->testRequest;
        $request = new Request($testReq);

        $message = $request->getMessage();
        $this->assertEquals($message->id, $testReq['message']['message_id']);

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

        $this->assertEmpty($message->entities);
    }
}
