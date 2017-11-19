<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Message;
use Telegram\Request;

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

    public function testRequest()
    {
        $request = new Request($this->testRequest);

        $message = $request->getMessage();
        $this->assertInstanceOf(Message::class, $message);

        $this->assertEquals($this->testRequest, $request->getOriginalRequest());
    }
}
