<?php

namespace Telegram\Entity\Factory;

use Telegram\Entity\Animation;
use Telegram\Entity\Audio;
use Telegram\Entity\CallbackQuery;
use Telegram\Entity\Chat;
use Telegram\Entity\ChatPhoto;
use Telegram\Entity\Contact;
use Telegram\Entity\Document;
use Telegram\Entity\Factory\Exception\ParseException;
use Telegram\Entity\Game\Game;
use Telegram\Entity\Inline\ChosenInlineResult;
use Telegram\Entity\Inline\InlineQuery;
use Telegram\Entity\Location;
use Telegram\Entity\Message;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\Passport\PassportData;
use Telegram\Entity\Payment\Invoice;
use Telegram\Entity\Payment\OrderInfo;
use Telegram\Entity\Payment\PreCheckoutQuery;
use Telegram\Entity\Payment\ShippingAddress;
use Telegram\Entity\Payment\ShippingQuery;
use Telegram\Entity\Payment\SuccessfulPayment;
use Telegram\Entity\PhotoSize;
use Telegram\Entity\Poll;
use Telegram\Entity\PollOption;
use Telegram\Entity\Sticker\Sticker;
use Telegram\Entity\Update\Update;
use Telegram\Entity\Update\UpdateCallbackQuery;
use Telegram\Entity\Update\UpdateChannelPost;
use Telegram\Entity\Update\UpdateChosenInlineResult;
use Telegram\Entity\Update\UpdateEditedChannelPost;
use Telegram\Entity\Update\UpdateEditedMessage;
use Telegram\Entity\Update\UpdateInlineQuery;
use Telegram\Entity\Update\UpdateMessage;
use Telegram\Entity\Update\UpdatePoll;
use Telegram\Entity\Update\UpdatePreCheckoutQuery;
use Telegram\Entity\Update\UpdateShippingQuery;
use Telegram\Entity\User;
use Telegram\Entity\Venue;
use Telegram\Entity\Video;
use Telegram\Entity\VideoNote;
use Telegram\Entity\Voice;

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

        if (!empty($data['message'])) {
            $update = new UpdateMessage($data['update_id']);

            $update->setMessage($this->createMessage($data['message']));
        } elseif (!empty($data['edited_message'])) {
            $update = new UpdateEditedMessage($data['update_id']);

            $update->setEditedMessage($this->createMessage($data['edited_message']));
        } elseif (!empty($data['channel_post'])) {
            $update = new UpdateChannelPost($data['update_id']);

            $update->setChannelPost($this->createMessage($data['channel_post']));
        } elseif (!empty($data['edited_channel_post'])) {
            $update = new UpdateEditedChannelPost($data['update_id']);

            $update->setEditedChannelPost(
                $this->createMessage($data['edited_channel_post'])
            );
        } elseif (!empty($data['inline_query'])) {
            $update = new UpdateInlineQuery($data['update_id']);

            $update->setInlineQuery($this->createInlineQuery($data['inline_query']));
        } elseif (!empty($data['chosen_inline_result'])) {
            $update = new UpdateChosenInlineResult($data['update_id']);

            $update->setChosenInlineResult($this->createChosenInlineResult($data['chosen_inline_result']));
        } elseif (!empty($data['callback_query'])) {
            $update = new UpdateCallbackQuery($data['update_id']);

            $update->setCallbackQuery($this->createCallbackQuery($data['callback_query']));
        } elseif (!empty($data['shipping_query'])) {
            $update = new UpdateShippingQuery($data['update_id']);

            $update->setShippingQuery($this->createShippingQuery($data['shipping_query']));
        } elseif (!empty($data['pre_checkout_query'])) {
            $update = new UpdatePreCheckoutQuery($data['update_id']);

            $update->setPreCheckoutQuery($this->createPreCheckoutQuery($data['pre_checkout_query']));
        } elseif (!empty($data['poll'])) {
            $update = new UpdatePoll($data['update_id']);

            $update->setPoll($this->createPoll($data['poll']));
        } else {
            return new Update($data['update_id']);
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

        if (!empty($data['from'])) {
            $message->setFrom($this->createUser($data['from']));
        }

        if (!empty($data['entities'])) {
            $message->setEntities($this->getMessageEntities($data['entities']));
        }

        if (!empty($data['caption_entities'])) {
            $message->setCaptionEntities($this->getMessageEntities($data['caption_entities']));
        }

        if (!empty($data['reply_to_message'])) {
            $message->setReplyToMessage($this->createMessage($data['reply_to_message']));
        }

        if (!empty($data['forward_from'])) {
            $message->setForwardFrom($this->createUser($data['forward_from']));
        }

        if (!empty($data['forward_from_chat'])) {
            $message->setForwardFromChat($this->createChat($data['forward_from_chat']));
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

        if (!empty($data['animation'])) {
            $message->setAnimation($this->createAnimation($data['animation']));
        }

        if (!empty($data['game'])) {
            $message->setGame($this->createGame($data['game']));
        }

        if (!empty($data['sticker'])) {
            $message->setSticker($this->createSticker($data['sticker']));
        }

        if (!empty($data['video'])) {
            $message->setVideo($this->createVideo($data['video']));
        }

        if (!empty($data['voice'])) {
            $message->setVoice($this->createVoice($data['voice']));
        }

        if (!empty($data['video_note'])) {
            $message->setVideoNote($this->createVideoNote($data['video_note']));
        }

        if (!empty($data['contact'])) {
            $message->setContact($this->createContact($data['contact']));
        }

        if (!empty($data['location'])) {
            $message->setLocation($this->createLocation($data['location']));
        }

        if (!empty($data['venue'])) {
            $message->setVenue($this->createVenue($data['venue']));
        }

        if (!empty($data['poll'])) {
            $message->setPoll($this->createPoll($data['poll']));
        }

        if (!empty($data['new_chat_members'])) {
            $message->setNewChatMembers($this->getUsers($data['new_chat_members']));
        }

        if (!empty($data['left_chat_member'])) {
            $message->setLeftChatMember($this->createUser($data['left_chat_member']));
        }

        if (!empty($data['new_chat_photo'])) {
            $message->setNewChatPhoto($this->getPhotos($data['new_chat_photo']));
        }

        if (!empty($data['pinned_message'])) {
            $message->setPinnedMessage($this->createMessage($data['pinned_message']));
        }

        if (!empty($data['invoice'])) {
            $message->setInvoice($this->createInvoice($data['invoice']));
        }

        if (!empty($data['successful_payment'])) {
            $message->setSuccessfulPayment($this->createSuccessfulPayment($data['successful_payment']));
        }

        if (!empty($data['passport_data'])) {
            $message->setPassportData($this->createPassportData($data['passport_data']));
        }

        $message->setText($data['text'] ?? null);
        $message->setForwardFromMessageId($data['forward_from_message_id'] ?? null);
        $message->setForwardSignature($data['forward_signature'] ?? null);
        $message->setForwardSenderName($data['forward_sender_name'] ?? null);
        $message->setForwardDate($data['forward_date'] ?? null);
        $message->setEditDate($data['edit_date'] ?? null);
        $message->setEditDate($data['edit_date'] ?? null);
        $message->setMediaGroupId($data['media_group_id'] ?? null);
        $message->setAuthorSignature($data['author_signature'] ?? null);
        $message->setCaption($data['caption'] ?? null);
        $message->setNewChatTitle($data['new_chat_title'] ?? null);
        $message->setDeleteChatPhoto($data['delete_chat_photo'] ?? false);
        $message->setGroupChatCreated($data['group_chat_created'] ?? false);
        $message->setSupergroupChatCreated($data['supergroup_chat_created'] ?? false);
        $message->setChannelChatCreated($data['channel_chat_created'] ?? false);
        $message->setMigrateToChatId($data['migrate_to_chat_id'] ?? null);
        $message->setMigrateFromChatId($data['migrate_from_chat_id'] ?? null);
        $message->setConnectedWebsite($data['connected_website'] ?? null);

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
        return new Poll(
            $data['id'],
            $data['question'],
            $this->getPollOptions($data['options']),
            $data['isClosed']
        );
    }

    private function createPollOption(array $data): PollOption
    {
        return new PollOption($data['text'], $data['voter_count']);
    }

    /**
     * @param array $data
     * @return PollOption[]
     */
    private function getPollOptions(array $data): array
    {
        $options = [];

        foreach ($data['options'] as $option) {
            $options[] = $this->createPollOption($option);
        }

        return $options;
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

    private function createVideo(array $data): Video
    {
        $video = new Video(
            $data['file_id'],
            $data['width'],
            $data['height'],
            $data['duration']
        );

        if (!empty($data['thumb'])) {
            $video->setThumb($this->createPhotoSize($data['thumb']));
        }

        $video->setMimeType($data['mime_type'] ?? null);
        $video->setFileSize($data['file_size'] ?? null);

        return $video;
    }

    private function createVoice(array $data): Voice
    {
        $voice = new Voice($data['file_id'], $data['duration']);

        $voice->setMimeType($data['mime_type'] ?? null);
        $voice->setFileSize($data['file_size'] ?? null);

        return $voice;
    }

    /**
     * @param array $data
     * @return User[]
     */
    private function getUsers(array $data): array
    {
        $users = [];

        foreach ($data as $userData) {
            $users[] = $this->createUser($userData);
        }

        return $users;
    }

    // todo
    private function createVideoNote(array $data): VideoNote
    {
        return new VideoNote();
    }

    // todo
    private function createContact(array $data): Contact
    {
        return new Contact();
    }

    // todo
    private function createVenue(array $data): Venue
    {
        return new Venue();
    }

    // todo
    private function createInvoice(array $data): Invoice
    {
        return new Invoice();
    }

    // todo
    private function createSuccessfulPayment(array $data): SuccessfulPayment
    {
        return new SuccessfulPayment();
    }

    // todo
    private function createPassportData(array $data): PassportData
    {
        return new PassportData();
    }


    // todo
    private function createAnimation(array $data): Animation
    {
        return new Animation();
    }

    // todo
    private function createGame(array $data): Game
    {
        return new Game();
    }

    // todo
    private function createSticker(array $data): Sticker
    {
        return new Sticker();
    }
}
