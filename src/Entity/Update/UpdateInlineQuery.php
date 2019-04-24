<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Inline\InlineQuery;

class UpdateInlineQuery extends Update
{
    public function getInlineQuery(): InlineQuery
    {
        return parent::getInlineQuery();
    }
}
