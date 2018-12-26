<?php

namespace Telegram\Handler\Update;

use Fig\Http\Message\StatusCodeInterface;
use Telegram\Entity\Update;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\EntityParser;

class ManualUpdateHandler extends AbstractUpdateHandler implements HandlerInterface
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
     * @throws \Telegram\Kernel\Exception\EntityParserException
     */
    public function handle(): void
    {
        foreach ($this->getUpdates($this->request) as $update) {
            $this->handleUpdate($this->request, $update);
        }
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @return string|string[]
     */
    public function getAllowedUpdates()
    {
        return $this->allowedUpdates;
    }

    /**
     * @param string|string[] $allowedUpdates
     */
    public function setAllowedUpdates($allowedUpdates): void
    {
        $this->allowedUpdates = $allowedUpdates;
    }

    /**
     * @param RequestInterface $request
     * @return Update[]
     * @throws \Telegram\Kernel\Exception\EntityParserException
     */
    private function getUpdates(RequestInterface $request): array
    {
        $response = $request
            ->getUpdates(
                $this->offset,
                $this->limit,
                $this->timeout,
                $this->allowedUpdates
            );

        $updates = [];

        if ($response->getStatusCode() === StatusCodeInterface::STATUS_OK) {
            $updatesData = \GuzzleHttp\json_decode($response->getBody(), true);

            $parser = new EntityParser();

            foreach ($updatesData['result'] ?? [] as $updateData) {
                $updates[] = $parser->parseUpdate($updateData);
            }
        }

        return $updates;
    }
}
