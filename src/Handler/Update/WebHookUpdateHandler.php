<?php

namespace Telegram\Handler\Update;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use HttpHelper\StatusCode;
use Telegram\Kernel\EntityParser;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\RequestInterface;

class WebHookUpdateHandler extends AbstractUpdateHandler implements HandlerInterface
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
                $this->response = new Response(StatusCode::OK, [], $content);
            }
        }
    }

    /**
     * @param RequestInterface $request
     * @throws \Telegram\Exception\EntityParserException
     */
    public function handle(RequestInterface $request): void
    {
        if ($this->response) {
            $parser = new EntityParser();
            $updateData = \GuzzleHttp\json_decode($this->response->getBody(), true);

            if ($update = $parser->parseUpdate($updateData['result'] ?? [])) {
                $this->handleUpdate($request, $update);
            }
        }
    }
}
