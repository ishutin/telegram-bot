<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Message;

class UpdateChannelPost extends Update
{
    public function getChannelPost(): Message
    {
        return parent::getChannelPost();
    }
}
