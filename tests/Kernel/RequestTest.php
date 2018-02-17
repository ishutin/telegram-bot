<?php

namespace Test\Kernel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Chat;
use Telegram\Exception\RequestException;
use Telegram\Kernel\Request;

final class RequestTest extends TestCase
{
    public function testConstruct(): void
    {
        $request = new Request('xxxx-xxxx-xxxx-xxxx', new Client());

        $this->assertInstanceOf(Request::class, $request);
    }

    /**
     * @throws RequestException
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
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($mockData, $response->getBody());
    }

    /**
     * @throws RequestException
     */
    public function testSendMessage()
    {
        $request = new Request('xxxx', $this->clientMock([
            new Response(200, [], '{"ok":true}'),
            new Response(400, [], '{"ok":false}'),
        ]));

        $result = $request->sendMessage('example-chat-id', 'hello');

        $this->assertTrue($result);

        $this->expectException(RequestException::class);
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
