<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\CallbackQuery;

class UpdateCallbackQuery extends Update
{
    public function getCallbackQuery(): CallbackQuery
    {
        return parent::getCallbackQuery();
    }
}
