<?php

namespace Telegram\Handler\Update;

interface ManualUpdateHandlerInterface extends UpdateHandlerInterface
{
    public function getOffset(): int;

    public function setOffset(int $offset): void;

    public function getLimit(): int;

    public function setLimit(int $limit): void;

    public function getTimeout(): int;

    public function setTimeout(int $timeout): void;

    /**
     * @return string|string[]
     */
    public function getAllowedUpdates();

    /**
     * @param string|string[] $allowedUpdates
     */
    public function setAllowedUpdates($allowedUpdates): void;
}
