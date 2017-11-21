<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Request;
use Telegram\RequestInterface;

final class RequestTest extends TestCase
{
    /**
     * @var array
     */
    private $testRequest = [
        'update_id' => 1,
        'message' => [
            'message_id' => 1,
            'from' => [
                'id' => 1,
                'is_bot' => false,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'language_code' => 'en',
            ],
            'chat' => [
                'id' => 1,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'type' => 'private',
            ],
            'date' => 1511091561,
            'text' => 'test text message',
        ],
    ];

    public function testParseRequest()
    {
        $request = new Request($this->testRequest);

        $message = $request->getMessage();
        $this->assertInstanceOf(Message::class, $message);

        $this->assertEquals($this->testRequest, $request->getOriginalRequest());
    }

    public function testAttachedRequest()
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
