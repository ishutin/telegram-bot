<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Message;

class UpdateEditedMessage extends Update
{
    public function getEditedMessage(): Message
    {
        return parent::getEditedMessage();
    }
}
