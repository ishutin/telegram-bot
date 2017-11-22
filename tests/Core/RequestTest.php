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
            'chat' => [
                'id' => 777,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'type' => 'private',
            ],
            'date' => 1511091561,
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
}
