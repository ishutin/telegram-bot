<?php

namespace Telegram\Kernel\Handler;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Telegram\Helper\HttpCode;
use Telegram\Kernel\EntityParser;
use Telegram\Kernel\RequestInterface;

class WebHookHandler implements UpdateHandlerInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response = null)
    {
        $this->response = $response;

        if (is_null($this->response)) {
            if ($content = file_get_contents('php://input')) {
                $this->response = new Response(HttpCode::OK, [], $content);
            }
        }
    }

    public function handle(RequestInterface $request, callable $callback): void
    {
        if ($this->response) {
            $parser = new EntityParser();
            $updateData = \GuzzleHttp\json_decode($this->response->getBody(), true);

            if ($update = $parser->parseUpdate($updateData['result'] ?? [])) {
                $callback($update);
            }
        }
    }
}
