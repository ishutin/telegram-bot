<?php

namespace Telegram;

use Exception;
use Telegram\Entity\Message;
use Telegram\Exception\RequestException;

class Request implements RequestInterface
{
    /**
     * @var Message
     */
    private $message;

    /**
     * @var array
     */
    private $originalRequest = [];

    public function __construct(array $request)
    {
        $this->originalRequest = $request;
    }

    public function getMessage(): Message
    {
        if (!$this->message) {
            try {
                $request = $this->originalRequest;

                if (empty($request['message'])) {
                    throw new RequestException('Invalid request: empty message');
                }

                $this->message = (new RequestParser())->parseMessage($request['message']);
            } catch (Exception $e) {
                throw new RequestException($e->getMessage());
            }
        }

        return $this->message;
    }

    public function getOriginalRequest(): array
    {
        return $this->originalRequest;
    }


}
