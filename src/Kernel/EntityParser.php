<?php

namespace Telegram\Kernel;

use Telegram\Entity\Audio;
use Telegram\Entity\Chat;
use Telegram\Entity\ChatPhoto;
use Telegram\Entity\Document;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\Photo;
use Telegram\Entity\Update;
use Telegram\Entity\User;
use Telegram\Exception\EntityParserException;

class EntityParser
{
    /**
     * @param array $response
     * @return Update
     * @throws EntityParserException
     */
    public function parseUpdate(array $response): Update
    {
        if (empty($response['update_id'])) {
            throw new EntityParserException('Invalid response: empty update_id');
        }

        $update = new Update($response['update_id']);

        if (!empty($response['message'])) {
            $update->setMessage($this->parseMessage($response['message']));
        }

        if (!empty($response['edited_message'])) {
            $update->setEditedMessage($this->parseMessage($response['edited_message']));
        }

        if (!empty($response['channel_post'])) {
            $update->setChannelPost($this->parseMessage($response['channel_post']));
        }

        if (!empty($response['edited_channel_post'])) {
            $update->setEditedChannelPost($this->parseMessage($response['edited_channel_post']));
        }

        // ToDo: add parse all Update fields

        return $update;
    }

    /**
     * @param array $data
     * @return Message
     * @throws EntityParserException
     */
    public function parseMessage(array $data): Message
    {
        if (empty($data['message_id'])) {
            throw new EntityParserException('Invalid request: empty message.message_id');
        }

        if (empty($data['chat'])) {
            throw new EntityParserException('Invalid request: empty message.chat');
        }

        if (empty($data['date'])) {
            throw new EntityParserException('Invalid request: empty message.date');
        }

        $message = new Message($data['message_id'], $data['date'], $this->parseChat($data['chat']));

        if (!empty($data['text'])) {
            $message->setText($data['text']);
        }

        if (!empty($data['from'])) {
            $message->setFrom($this->parseUser($data['from']));
        }

        if (!empty($data['entities'])) {
            $messageEntities = [];

            foreach ($data['entities'] as $messageEntity) {
                $messageEntities[] = $this->parseMessageEntity($messageEntity);
            }

            $message->setEntities($messageEntities);
        }

        if (!empty($data['forward_from'])) {
            $message->setReplyTo($this->parseMessage($data['forward_from']));
        }

        if (!empty($data['audio'])) {
            $message->setAudio($this->parseAudio($data['audio']));
        }

        if (!empty($data['photo'])) {
            $photos = [];

            foreach ($data['photo'] as $photoData) {
                $photos[] = $this->parsePhoto($photoData);
            }

            $message->setPhotos($photos);
        }

        if (!empty($data['left_chat_member'])) {
            $message->setLeftChatMember($this->parseUser($data['left_chat_member']));
        }

        if (!empty($data['forward_from_chat'])) {
            $message->setForwardFromChat($this->parseChat($data['forward_from_chat']));
        }

        if (!empty($data['document'])) {
            $message->setDocument($this->parseDocument($data['document']));
        }

        return $message;
    }

    /**
     * @param array $data
     * @return Chat
     * @throws EntityParserException
     */
    public function parseChat(array $data): Chat
    {
        $chat = new Chat($data['id'], $data['type']);

        $chat->setTitle($data['title'] ?? null);
        $chat->setUsername($data['username'] ?? null);
        $chat->setFirstName($data['first_name'] ?? null);
        $chat->setLastName($data['last_name'] ?? null);
        $chat->setAllMembersAreAdministrators($data['all_members_are_administrators'] ?? null);
        $chat->setDescription($data['description'] ?? null);
        $chat->setInviteLink($data['invite_link'] ?? null);
        $chat->setStickerSetName($data['sticker_set_name'] ?? null);
        $chat->setCanSetStickerSet($data['can_set_sticker_set'] ?? null);

        if (!empty($data['pinned_message'])) {
            $chat->setPinnedMessage($this->parseMessage($data['pinned_message']));
        }

        if (!empty($data['photo'])) {
            $chat->setPhoto($this->parseChatPhoto($data['photo']));
        }

        return $chat;
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

        $audio->setPerformer($data['performer'] ?? null);
        $audio->setTitle($data['title'] ?? null);
        $audio->setMimeType($data['mime_type'] ?? null);
        $audio->setFileSize($data['file_size'] ?? null);

        return $audio;
    }

    public function parsePhoto(array $data): Photo
    {
        $photo = new Photo($data['file_id'], $data['width'], $data['height']);

        $photo->setFileSize($data['file_size'] ?? null);

        return $photo;
    }

    public function parseChatPhoto(array $data): ChatPhoto
    {
        return new ChatPhoto($data['small_file_id'], $data['big_file_id']);
    }

    public function parseMessageEntity(array $data): MessageEntity
    {
        return new MessageEntity($data['type'], $data['offset'], $data['length']);
    }

    public function parseDocument(array $data): Document
    {
        $document = new Document($data['file_id']);

        $document->setFileName($data['file_name'] ?? null);
        $document->setFileSize($data['file_size'] ?? null);
        $document->setMimeType($data['mime_type'] ?? null);

        if (!empty($data['thumb'])) {
            $document->setThumb($this->parsePhoto($data['thumb']));
        }

        return $document;
    }
}
