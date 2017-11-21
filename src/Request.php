<?php

namespace Telegram;

use Exception;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\User;
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

                $this->message = $this->createMessage($request['message']);
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

        $message = new Message(
            $data['message_id'],
            $data['date'],
            $this->createChat($data['chat'])
        );

        if (!empty($data['text'])) {
            $message->text = $data['text'];
        }

        if (!empty($data['from'])) {
            $message->from = $this->createUser($data['from']);
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
            $message->replyTo = $this->createMessage($data['forward_from']);
        }

        return $message;
    }

    private function createChat(array $data): Chat
    {
        return new Chat($data['id'], $data['type']);
    }

    private function createUser(array $data): User
    {
        return new User(
            $data['id'],
            $data['first_name'],
            $data['last_name'],
            $data['username'],
            $data['language_code'],
            $data['is_bot']
        );
    }
}
