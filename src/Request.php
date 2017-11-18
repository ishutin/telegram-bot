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

    public function __construct(array $request)
    {
        try {
            if (empty($request['message'])) {
                throw new RequestException('Invalid request: empty message');
            }

            $message = $request['message'];

            if (empty($message['chat'])) {
                throw new RequestException('Invalid request: empty message.chat');
            }

            if (empty($message['from'])) {
                throw new RequestException('Invalid request: empty message.from');
            }

            $from = $message['from'];
            $chat = $message['chat'];

            $chatEntity = new Chat($chat['id'], $chat['type']);

            $fromUser = new User(
                $from['id'],
                $from['first_name'],
                $from['last_name'],
                $from['username'],
                $from['language_code'],
                $from['is_bot']
            );

            $messageEntities = [];

            if (!empty($message['entities'])) {
                foreach ($message['entities'] as $messageEntity) {
                    $messageEntities[] = new MessageEntity(
                        $messageEntity['type'],
                        $messageEntity['offset'],
                        $messageEntity['length']
                    );
                }
            }

            $this->message = new Message(
                $message['message_id'],
                $fromUser,
                $chatEntity,
                $message['text'] ?? null,
                $messageEntities
            );
        } catch (Exception $e) {
            throw new RequestException($e->getMessage());
        }
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
