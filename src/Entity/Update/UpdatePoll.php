<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Poll;

class UpdatePoll extends Update
{
    public function getPoll(): Poll
    {
        return parent::getPoll();
    }
}
