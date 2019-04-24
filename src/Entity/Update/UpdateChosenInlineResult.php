<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Inline\ChosenInlineResult;

class UpdateChosenInlineResult extends Update
{
    public function getChosenInlineResult(): ChosenInlineResult
    {
        return parent::getChosenInlineResult();
    }
}
