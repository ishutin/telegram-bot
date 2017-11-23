<?php

namespace Telegram\Kernel\Handler;

use Telegram\Entity\Update;
use Telegram\Helper\HttpCode;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\EntityParser;

class ManuallyHandler implements UpdateHandlerInterface
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
    private $allowedUpdates = null;

    public function __construct(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        array $allowedUpdates = null
    ) {
        $this->offset = $offset;
        $this->limit = $limit;
        $this->timeout = $timeout;
        $this->allowedUpdates = $allowedUpdates;
    }

    public function handle(RequestInterface $request, callable $callback): void
    {
        foreach ($this->getUpdates($request) as $update) {
            $callback($update);
        }
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param array|string $allowedUpdates
     *
     * @return Update[]
     */
    private function getUpdates(RequestInterface $request): array
    {
        $response = $request->getUpdates(
            $this->offset,
            $this->limit,
            $this->timeout,
            $this->allowedUpdates
        );

        $updates = [];

        if ($response->getStatusCode() === HttpCode::OK) {
            $updatesData = \GuzzleHttp\json_decode($response->getBody(), true);

            $parser = new EntityParser();

            foreach ($updatesData['result'] ?? [] as $updateData) {
                $updates[] = $parser->parseUpdate($updateData);
            }
        }

        return $updates;
    }
}
