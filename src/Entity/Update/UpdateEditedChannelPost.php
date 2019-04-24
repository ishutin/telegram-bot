<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Message;

class UpdateEditedChannelPost extends Update
{
    public function getEditedChannelPost(): Message
    {
        return parent::getEditedChannelPost();
    }
}
