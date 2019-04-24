<?php

namespace Telegram\Handler\Update;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Factory\EntityFactoryInterface;

class WebHookUpdateHandler implements WebHookUpdateHandlerInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var EntityFactoryInterface
     */
    private $entityFactory;

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
    public function getUpdates(): ?array
    {
        if ($this->response instanceof ResponseInterface) {
            $data = \GuzzleHttp\json_decode($this->response->getBody(), true);

            if (empty($data)) {
                return null;
            }

            return [$this->getEntityFactory()->createUpdate($data)];
        }

        return [];
    }

    public function getEntityFactory(): EntityFactoryInterface
    {
        return $this->entityFactory;
    }

    public function setEntityFactory(EntityFactoryInterface $entityFactory): WebHookUpdateHandlerInterface
    {
        $this->entityFactory = $entityFactory;

        return $this;
    }
}
