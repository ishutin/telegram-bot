<?php

namespace Telegram\Kernel;

use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\Photo;
use Telegram\Entity\User;
use Telegram\Exception\RequestParserException;

class RequestParser
{
    public function parseMessage(array $data): Message
    {
        if (empty($data['message_id'])) {
            throw new RequestParserException('Invalid request: empty message.message_id');
        }

        if (empty($data['chat'])) {
            throw new RequestParserException('Invalid request: empty message.chat');
        }

        if (empty($data['date'])) {
            throw new RequestParserException('Invalid request: empty message.date');
        }

        $message = new Message(
            $data['message_id'],
            $data['date'],
            $this->parseChat($data['chat'])
        );

        if (!empty($data['text'])) {
            $message->text = $data['text'];
        }

        if (!empty($data['from'])) {
            $message->from = $this->parseUser($data['from']);
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
            $message->replyTo = $this->parseMessage($data['forward_from']);
        }

        if (!empty($data['audio'])) {
            $message->audio = $this->parseAudio($data['audio']);
        }

        if (!empty($data['photo'])) {
            $photos = [];

            foreach ($data['photo'] as $photoData) {
                $photos[] = $this->parsePhotos($photoData);
            }

            $message->photos = $photos;
        }

        if (!empty($data['left_chat_member'])) {
            $message->leftChatMember = $this->parseUser($data['left_chat_member']);
        }

        return $message;
    }

    public function parseChat(array $data): Chat
    {
        return new Chat($data['id'], $data['type']);
    }

    public function parseUser(array $data): User
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

    public function parseAudio(array $data): Audio
    {
        $audio = new Audio($data['file_id'], $data['duration']);
        $audio->performer = $data['performer'] ?? null;
        $audio->title = $data['title'] ?? null;
        $audio->mimeType = $data['mime_type'] ?? null;
        $audio->fileSize = $data['file_size'] ?? null;

        return $audio;
    }

    public function parsePhotos(array $data): Photo
    {
        $photo = new Photo($data['file_id'], $data['width'], $data['height']);
        $photo->fileSize = $data['file_size'] ?? null;

        return $photo;
    }
}
