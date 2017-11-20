<?php

namespace Telegram;

use Exception;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\User;
use Telegram\Exception\RequestException;

class Request
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

        try {
            if (empty($request['message'])) {
                throw new RequestException('Invalid request: empty message');
            }

            $this->message = $this->createMessage($request['message']);
        } catch (Exception $e) {
            throw new RequestException($e->getMessage());
        }
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function getOriginalRequest(): array
    {
        return $this->originalRequest;
    }

    private function createMessage(array $data): Message
    {
        if (empty($data['message_id'])) {
            throw new RequestException('Invalid request: empty message.message_id');
        }

        if (empty($data['chat'])) {
            throw new RequestException('Invalid request: empty message.chat');
        }

        if (empty($data['date'])) {
            throw new RequestException('Invalid request: empty message.date');
        }

        $chat = $data['chat'];
        $chatEntity = new Chat($chat['id'], $chat['type']);

        $message = new Message($data['message_id'], $chatEntity, $data['date']);

        if (!empty($data['text'])) {
            $message->text = $data['text'];
        }

        if (!empty($data['from'])) {
            $from = $data['from'];

            $fromUser = new User(
                $from['id'],
                $from['first_name'],
                $from['last_name'],
                $from['username'],
                $from['language_code'],
                $from['is_bot']
            );

            $message->from = $fromUser;
        }

        if (!empty($data['entities'])) {
            $messageEntities = [];

            foreach ($data['entities'] as $messageEntity) {
                $messageEntities[] = new MessageEntity(
                    $messageEntity['type'],
                    $messageEntity['offset'],
                    $messageEntity['length']
                );
            }

            $message->entities = $messageEntities;
        }

        if (!empty($data['forward_from'])) {
            $message->forwardFrom = $this->createMessage($data['forward_from']);
        }

        return $message;
    }
}
