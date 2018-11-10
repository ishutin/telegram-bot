<?php

namespace Test\Kernel;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\Document;
use Telegram\Entity\Message;
use Telegram\Entity\User;
use Telegram\Kernel\EntityParser;

final class EntityParserTest extends TestCase
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
            'forward_from_chat' => [
                'id' => 666,
                'first_name' => 'Test2',
                'last_name' => 'Unit2',
                'username' => 'unit_test2',
                'type' => 'private',
            ],
            'document' => ['file_id' => 'xxx-xxx-xxx-xxx'],
        ],
    ];

    /**
     * @throws \Telegram\Exception\EntityParserException
     */
    public function testMessageParser(): void
    {
        $parser = new EntityParser();
        $request = $this->testRequest;

        $update = $parser->parseUpdate($request);

        $message = $update->getMessage();
        $this->assertInstanceOf(Message::class, $message);
        $this->assertEquals($message->getId(), $request['message']['message_id']);
        $this->assertEquals($message->getDate(), $request['message']['date']);

        $chat = $message->getChat();
        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertEquals($chat->getId(), $request['message']['chat']['id']);
        $this->assertEquals($chat->getType(), $chat::TYPE_PRIVATE_CHAT);

        $from = $message->getFrom();
        $this->assertInstanceOf(User::class, $from);
        $this->assertEquals($from->getId(), $request['message']['from']['id']);
        $this->assertEquals($from->getIsBot(), $request['message']['from']['is_bot']);
        $this->assertEquals($from->getFirstName(), $request['message']['from']['first_name']);
        $this->assertEquals($from->getLastName(), $request['message']['from']['last_name']);
        $this->assertEquals($from->getUsername(), $request['message']['from']['username']);
        $this->assertEquals($from->getLang(), $request['message']['from']['language_code']);

        $this->assertEquals($message->getText(), $request['message']['text']);

        $this->assertNotEmpty($message->getEntities());

        $audio = $message->getAudio();
        $this->assertInstanceOf(Audio::class, $audio);
        $this->assertEquals($audio->getFileId(), $request['message']['audio']['file_id']);
        $this->assertEquals($audio->getDuration(), $request['message']['audio']['duration']);

        $photos = $message->getPhotos();
        $this->assertNotEmpty($photos);

        $leftMember = $message->getLeftChatMember();
        $this->assertInstanceOf(User::class, $leftMember);
        $this->assertEquals($leftMember->getId(), $request['message']['left_chat_member']['id']);
        $this->assertEquals($leftMember->getIsBot(), $request['message']['left_chat_member']['is_bot']);
        $this->assertEquals($leftMember->getFirstName(), $request['message']['left_chat_member']['first_name']);
        $this->assertEquals($leftMember->getLastName(), $request['message']['left_chat_member']['last_name']);
        $this->assertEquals($leftMember->getUsername(), $request['message']['left_chat_member']['username']);
        $this->assertEquals($leftMember->getLang(), $request['message']['left_chat_member']['language_code']);

        $chat = $message->getForwardFromChat();
        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertEquals($chat->getId(), $request['message']['forward_from_chat']['id']);
        $this->assertEquals($chat->getType(), $chat::TYPE_PRIVATE_CHAT);

        $document = $message->getDocument();
        $this->assertInstanceOf(Document::class, $document);
        $this->assertEquals($document->getFileId(), $request['message']['document']['file_id']);
    }

}
