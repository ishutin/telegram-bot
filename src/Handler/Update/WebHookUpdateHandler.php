<?php

namespace Telegram\Handler\Update;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Telegram\Kernel\EntityParser;

class WebHookUpdateHandler implements WebHookUpdateHandlerInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response = null)
    {
        $this->response = $response;

        if (($this->response === null) && $content = file_get_contents('php://input')) {
            $this->response = new Response(
                StatusCodeInterface::STATUS_OK,
                [],
                $content
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function getUpdates(): array
    {
        if ($this->response instanceof ResponseInterface) {
            $parser = new EntityParser();
            $updateData = \GuzzleHttp\json_decode($this->response->getBody(), true);

            if ($update = $parser->parseUpdate($updateData['result'] ?? [])) {
                return [$update];
            }
        }

        return [];
    }
}
