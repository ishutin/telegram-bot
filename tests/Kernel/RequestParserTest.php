<?php

namespace Test\Kernel;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\User;
use Telegram\Kernel\RequestParser;

final class RequestParserTest extends TestCase
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

            'left_chat_member' => [
                'id' => 4444,
                'is_bot' => false,
                'first_name' => 'Test2',
                'last_name' => 'Unit2',
                'username' => 'unit_test2',
                'language_code' => 'en',
            ],
        ],
    ];

    public function testMessageParser(): void
    {
        $parser = new RequestParser();
        $request = $this->testRequest;

        $message = $parser->parseMessage($request['message']);

        $this->assertEquals($message->id, $request['message']['message_id']);
        $this->assertEquals($message->date, $request['message']['date']);

        $chat = $message->chat;
        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertEquals($chat->type, $chat::TYPE_PRIVATE_CHAT);
        $this->assertEquals($chat->id, $request['message']['chat']['id']);

        $from = $message->from;
        $this->assertInstanceOf(User::class, $from);
        $this->assertEquals($from->id, $request['message']['from']['id']);
        $this->assertEquals($from->isBot, $request['message']['from']['is_bot']);
        $this->assertEquals($from->firstName, $request['message']['from']['first_name']);
        $this->assertEquals($from->lastName, $request['message']['from']['last_name']);
        $this->assertEquals($from->username, $request['message']['from']['username']);
        $this->assertEquals($from->lang, $request['message']['from']['language_code']);

        $this->assertEquals($message->text, $request['message']['text']);

        $this->assertNotEmpty($message->entities);

        $audio = $message->audio;
        $this->assertInstanceOf(Audio::class, $audio);
        $this->assertEquals($audio->id, $request['message']['audio']['file_id']);
        $this->assertEquals($audio->duration, $request['message']['audio']['duration']);

        $photos = $message->photos;
        $this->assertNotEmpty($photos);

        $leftMember = $message->leftChatMember;
        $this->assertInstanceOf(User::class, $leftMember);
        $this->assertEquals($leftMember->id, $request['message']['left_chat_member']['id']);
        $this->assertEquals($leftMember->isBot, $request['message']['left_chat_member']['is_bot']);
        $this->assertEquals($leftMember->firstName, $request['message']['left_chat_member']['first_name']);
        $this->assertEquals($leftMember->lastName, $request['message']['left_chat_member']['last_name']);
        $this->assertEquals($leftMember->username, $request['message']['left_chat_member']['username']);
        $this->assertEquals($leftMember->lang, $request['message']['left_chat_member']['language_code']);
    }

}
