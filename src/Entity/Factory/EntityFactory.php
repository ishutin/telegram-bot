<?php

namespace Telegram\Entity\Factory;

use Telegram\Entity\Audio;
use Telegram\Entity\CallbackQuery;
use Telegram\Entity\Chat;
use Telegram\Entity\ChatPhoto;
use Telegram\Entity\Document;
use Telegram\Entity\Factory\Exception\ParseException;
use Telegram\Entity\Inline\ChosenInlineResult;
use Telegram\Entity\Inline\InlineQuery;
use Telegram\Entity\Location;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\Payment\OrderInfo;
use Telegram\Entity\Payment\PreCheckoutQuery;
use Telegram\Entity\Payment\ShippingAddress;
use Telegram\Entity\Payment\ShippingQuery;
use Telegram\Entity\PhotoSize;
use Telegram\Entity\Poll;
use Telegram\Entity\PollOption;
use Telegram\Entity\Update;
use Telegram\Entity\User;

class EntityFactory implements EntityFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createUpdate(array $data): Update
    {
        if (empty($data['update_id'])) {
            throw new ParseException('Invalid response: empty update_id');
        }

        $update = new Update($data['update_id']);

        if (!empty($data['message'])) {
            $update->setMessage($this->createMessage($data['message']));
        }

        if (!empty($data['edited_message'])) {
            $update->setEditedMessage($this->createMessage($data['edited_message']));
        }

        if (!empty($data['channel_post'])) {
            $update->setChannelPost($this->createMessage($data['channel_post']));
        }

        if (!empty($data['edited_channel_post'])) {
            $update->setEditedChannelPost($this->createMessage($data['edited_channel_post']));
        }

        if (!empty($data['inline_query'])) {
            $update->setInlineQuery($this->createInlineQuery($data['inline_query']));
        }

        if (!empty($data['chosen_inline_result'])) {
            $update->setChosenInlineResult($this->createChosenInlineResult($data['chosen_inline_result']));
        }

        if (!empty($data['callback_query'])) {
            $update->setCallbackQuery($this->createCallbackQuery($data['callback_query']));
        }

        if (!empty($data['shipping_query'])) {
            $update->setShippingQuery($this->createShippingQuery($data['shipping_query']));
        }

        if (!empty($data['pre_checkout_query'])) {
            $update->setPreCheckoutQuery($this->createPreCheckoutQuery($data['pre_checkout_query']));
        }

        if (!empty($data['poll'])) {
            $update->setPoll($this->createPoll($data['poll']));
        }

        return $update;
    }

    /**
     * @param array $data
     * @return Message
     * @throws ParseException
     */
    private function createMessage(array $data): Message
    {
        if (empty($data['message_id'])) {
            throw new ParseException('Invalid request: empty message.message_id');
        }

        if (empty($data['chat'])) {
            throw new ParseException('Invalid request: empty message.chat');
        }

        if (empty($data['date'])) {
            throw new ParseException('Invalid request: empty message.date');
        }

        $message = new Message($data['message_id'], $data['date'], $this->createChat($data['chat']));

        if (!empty($data['text'])) {
            $message->setText($data['text']);
        }

        if (!empty($data['from'])) {
            $message->setFrom($this->createUser($data['from']));
        }

        if (!empty($data['entities'])) {
            $message->setEntities($this->getMessageEntities($data['entities']));
        }

        if (!empty($data['forward_from'])) {
            $message->setReplyTo($this->createMessage($data['forward_from']));
        }

        if (!empty($data['audio'])) {
            $message->setAudio($this->createAudio($data['audio']));
        }

        if (!empty($data['photo'])) {
            $message->setPhoto($this->getPhotos($data['photo']));
        }

        if (!empty($data['left_chat_member'])) {
            $message->setLeftChatMember($this->createUser($data['left_chat_member']));
        }

        if (!empty($data['forward_from_chat'])) {
            $message->setForwardFromChat($this->createChat($data['forward_from_chat']));
        }

        if (!empty($data['document'])) {
            $message->setDocument($this->createDocument($data['document']));
        }

        return $message;
    }

    /**
     * @param array $data
     * @return Chat
     * @throws ParseException
     */
    private function createChat(array $data): Chat
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
            $chat->setPinnedMessage($this->createMessage($data['pinned_message']));
        }

        if (!empty($data['photo'])) {
            $chat->setPhoto($this->createChatPhoto($data['photo']));
        }

        return $chat;
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

    private function createAudio(array $data): Audio
    {
        $audio = new Audio($data['file_id'], $data['duration']);

        $audio->setPerformer($data['performer'] ?? null);
        $audio->setTitle($data['title'] ?? null);
        $audio->setMimeType($data['mime_type'] ?? null);
        $audio->setFileSize($data['file_size'] ?? null);

        if (!empty($data['thumb'])) {
            $audio->setThumb($this->createPhotoSize($data['thumb']));
        }

        return $audio;
    }

    private function createChatPhoto(array $data): ChatPhoto
    {
        return new ChatPhoto($data['small_file_id'], $data['big_file_id']);
    }

    private function createMessageEntity(array $data): MessageEntity
    {
        $messageEntity = new MessageEntity($data['type'], $data['offset'], $data['length']);

        $messageEntity->setUrl($data['url'] ?? null);

        if (!empty($data['user'])) {
            $messageEntity->setUser($this->createUser($data['user']));
        }

        return $messageEntity;
    }

    private function createDocument(array $data): Document
    {
        $document = new Document($data['file_id']);

        $document->setFileName($data['file_name'] ?? null);
        $document->setFileSize($data['file_size'] ?? null);
        $document->setMimeType($data['mime_type'] ?? null);

        if (!empty($data['thumb'])) {
            $document->setThumb($this->createPhotoSize($data['thumb']));
        }

        return $document;
    }

    private function createInlineQuery(array $data): InlineQuery
    {
        $query = new InlineQuery($data['id'], $this->createUser($data['from']), $data['query'], $data['offset']);

        if (!empty($data['location'])) {
            $query->setLocation($this->createLocation($data['location']));
        }

        return $query;
    }

    private function createLocation(array $data): Location
    {
        return new Location($data['longitude'], $data['latitude']);
    }

    private function createChosenInlineResult(array $data): ChosenInlineResult
    {
        $result = new ChosenInlineResult($data['result_id'], $this->createUser($data['from']), $data['query']);

        if (!empty($data['location'])) {
            $result->setLocation($this->createLocation($data['location']));
        }

        if (!empty($data['inline_message_id'])) {
            $result->setInlineMessageId($data['inline_message_id']);
        }

        return $result;
    }

    private function createCallbackQuery(array $data): CallbackQuery
    {
        $query = new CallbackQuery($data['id'], $this->createUser($data['from']), $data['chat_instance']);

        if (!empty($data['message'])) {
            $query->setMessage($this->createMessage($data['message']));
        }

        if (!empty($data['inline_message_id'])) {
            $query->setInlineMessageId($data['inline_message_id']);
        }

        if (!empty($data['data'])) {
            $query->setData($data['data']);
        }

        if (!empty($data['game_short_name'])) {
            $query->setGameShortName($data['game_short_name']);
        }

        return $query;
    }

    private function createShippingQuery(array $data): ShippingQuery
    {
        return new ShippingQuery(
            $data['id'],
            $this->createUser($data['from']),
            $data['invoice_payload'],
            $this->createShippingAddress($data['shipping_address'])
        );
    }

    private function createShippingAddress(array $data): ShippingAddress
    {
        return new ShippingAddress(
            $data['country_code'],
            $data['state'],
            $data['city'],
            $data['street_line1'],
            $data['street_line2'],
            $data['post_code']
        );
    }

    private function createPreCheckoutQuery(array $data): PreCheckoutQuery
    {
        $query = new PreCheckoutQuery(
            $data['id'],
            $this->createUser($data['from']),
            $data['currency'],
            $data['total_amount'],
            $data['invoice_payload']
        );

        $query->setShippingOptionId($data['shipping_option_id'] ?? null);

        if (!empty($data['order_info'])) {
            $query->setOrderInfo($this->createOrderInfo($data['order_info']));
        }

        return $query;
    }

    private function createOrderInfo(array $data): OrderInfo
    {
        $info = new OrderInfo();

        $info->setName($data['name'] ?? null);
        $info->setEmail($data['email'] ?? null);
        $info->setPhoneNumber($data['phone_number'] ?? null);
        if (!empty($data['shipping_address'])) {
            $info->setShippingAddress(
                $this->createShippingAddress($data['shipping_address'])
            );
        }

        return $info;
    }

    private function createPoll(array $data): Poll
    {
        $options = [];

        foreach ($data['options'] as $option) {
            $options[] = $this->createPollOption($option);
        }

        return new Poll($data['id'], $data['question'], $options, $data['isClosed']);
    }

    private function createPollOption(array $data): PollOption
    {
        return new PollOption($data['text'], $data['voter_count']);
    }

    /**
     * @param array $data
     * @return MessageEntity[]
     */
    private function getMessageEntities(array $data): array
    {
        $messageEntities = [];

        foreach ($data as $messageEntity) {
            $messageEntities[] = $this->createMessageEntity($messageEntity);
        }

        return $messageEntities;
    }

    /**
     * @param array $data
     * @return PhotoSize[]
     */
    private function getPhotos(array $data): array
    {
        $photos = [];

        foreach ($data as $photoData) {
            $photos[] = $this->createPhotoSize($photoData);
        }

        return $photos;
    }

    private function createPhotoSize(array $data): PhotoSize
    {
        $photo = new PhotoSize(
            $data['file_id'],
            $data['width'],
            $data['height']
        );

        $photo->setFileSize($data['file_size'] ?? null);

        return $photo;
    }
}
