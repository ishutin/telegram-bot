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

    public function __construct(RequestInterface $request, ResponseInterface $response = null)
    {
        parent::__construct($request);

        $this->response = $response;

        if (is_null($this->response)) {
            if ($content = file_get_contents('php://input')) {
                $this->response = new Response(StatusCode::OK, [], $content);
            }
        }
    }

    /**
     * @throws \Telegram\Exception\EntityParserException
     */
    public function handle(): void
    {
        if ($this->response) {
            $parser = new EntityParser();
            $updateData = \GuzzleHttp\json_decode($this->response->getBody(), true);

            if ($update = $parser->parseUpdate($updateData['result'] ?? [])) {
                $this->handleUpdate($this->request, $update);
            }
        }
    }
}
