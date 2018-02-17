<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Update;
use HttpHelper\StatusCode;
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
    private $allowedUpdates = null;

    /**
     * ManualHandler constructor.
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param string[]|string|null $allowedUpdates
     */
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

    /**
     * @param RequestInterface $request
     * @throws \Telegram\Exception\EntityParserException
     */
    public function handle(RequestInterface $request): void
    {
        foreach ($this->getUpdates($request) as $update) {
            $this->handleUpdate($request, $update);
        }
    }

    /**
     * @param RequestInterface $request
     * @return Update[]
     * @throws \Telegram\Exception\EntityParserException
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

        if ($response->getStatusCode() === StatusCode::OK) {
            $updatesData = \GuzzleHttp\json_decode($response->getBody(), true);

            $parser = new EntityParser();

            foreach ($updatesData['result'] ?? [] as $updateData) {
                $updates[] = $parser->parseUpdate($updateData);
            }
        }

        return $updates;
    }
}
