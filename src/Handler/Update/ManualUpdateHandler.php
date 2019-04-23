<?php

namespace Telegram\Handler\Update;

use Fig\Http\Message\StatusCodeInterface;
use Telegram\Kernel\RequestInterface;

class ManualUpdateHandler implements ManualUpdateHandlerInterface
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $timeout;

    /**
     * @var string|string[]
     */
    private $allowedUpdates;

    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedUpdates()
    {
        return $this->allowedUpdates;
    }

    /**
     * @inheritDoc
     */
    public function setAllowedUpdates($allowedUpdates): void
    {
        $this->allowedUpdates = $allowedUpdates;
    }

    /**
     * @inheritDoc
     */
    public function getResponseData(): array
    {
        $response = $this->request
            ->getUpdates(
                $this->offset,
                $this->limit,
                $this->timeout,
                $this->allowedUpdates
            );

        if ($response->getStatusCode() === StatusCodeInterface::STATUS_OK) {
            $updatesData = \GuzzleHttp\json_decode($response->getBody(), true);

            return $updatesData['result'] ?? [];
        }

        return [];
    }
}
