<?php

namespace Telegram\Kernel\Handler;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
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
            $this->response = new Response(
                200,
                [],
                file_get_contents('php://input')
            );
        }
    }

    public function handle(RequestInterface $request, callable $callback): void
    {
        $parser = new EntityParser();

        $updateData = $request->parseJson($this->response);

        if ($update = $parser->parseUpdate($updateData)) {
            $callback($update);
        }
    }
}
