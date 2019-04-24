<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Message;

class UpdateMessage extends Update
{
    public function getMessage(): Message
    {
        return parent::getMessage();
    }
}
