<?php

namespace Test\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Telegram\Http\Exception\HttpRequestException;
use Telegram\Http\Request;

final class RequestTest extends TestCase
{
    public function testConstruct(): void
    {
        $request = new Request('xxxx-xxxx-xxxx-xxxx');

        $this->assertInstanceOf(ClientInterface::class, $request->getClient());
    }

    /**
     * @throws HttpRequestException
     */
    public function testGetUpdates(): void
    {
        $mockData = json_encode([
            'ok' => true,
            'result' => [
                'update_id' => 1,
                'message' => [
                    'message_id' => 1,
                    'chat' => [
                        'id' => 1,
                        'type' => 'private',
                    ],
                    'date' => 12345,
                ],
            ],
        ]);

        $request = new Request(
            'xxxx-xxxx-xxxx-xxxx',
            $this->clientMock([
                new Response(200, [], $mockData),
            ])
        );

        $response = $request->getUpdates();
        $this->assertEquals($mockData, $response->getBody());
    }

    /**
     * @throws HttpRequestException
     */
    public function testSendMessage(): void
    {
        $this->markTestSkipped('refactoring');
        $request = new Request('xxxx', $this->clientMock([
            new Response(200, [], '{"ok":true}'),
            new Response(400, [], '{"ok":false}'),
        ]));

        $result = $request->sendMessage('example-chat-id', 'hello');

        $this->assertTrue($result);

        $this->expectException(HttpRequestException::class);
        $request->sendMessage('example-chat-id', 'hello');
    }

    /**
     * @param ResponseInterface[] $responses
     * @return ClientInterface
     */
    private function clientMock(array $responses = []): ClientInterface
    {
        $handler = HandlerStack::create(
            new MockHandler($responses)
        );

        return new Client(['handler' => $handler]);
    }
}
